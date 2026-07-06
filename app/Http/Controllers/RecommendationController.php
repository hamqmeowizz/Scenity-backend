<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class RecommendationController extends Controller
{
    private const WEATHER_OPTIONS = [
        'Crisp & Sunny',
        'Cold / Overcast',
        'Hot / Humid',
        'Balmy Evening',
    ];

    public function index()
    {
        return view('recommendations', [
            'alternativePerfumes' => Perfume::inRandomOrder()
                ->limit(3)
                ->get(),
        ]);
    }

    public function detectLocalWeather(Request $request)
    {
        $validated = $request->validate([
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ]);

        $weatherContext = $this->resolveWeatherContext(
            $validated['latitude'] ?? null,
            $validated['longitude'] ?? null
        );

        return response()->json([
            'weather_suitability' => $weatherContext['computed_climate'],
            'temperature' => $weatherContext['temperature'],
            'description' => $weatherContext['description'],
            'humidity' => $weatherContext['humidity'],
        ]);
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'scent_family' => ['required', Rule::in(['Woody', 'Floral', 'Fresh', 'Oriental', 'Spicy'])],
            'occasion_focus' => ['required', Rule::in(['Everyday Lounge', 'Office & Professional', 'Evening & Gala'])],
            'weather_suitability' => ['nullable', Rule::in(self::WEATHER_OPTIONS)],
        ]);

        $longevity = 'moderate';
        $sillage = 'moderate';

        if ($request->occasion_focus === 'Everyday Lounge') {
            $longevity = 'weak';
            $sillage = 'soft';
        } elseif ($request->occasion_focus === 'Evening & Gala') {
            $longevity = 'strong';
            $sillage = 'heavy';
        }

        $weatherSuitability = $validated['weather_suitability'] ?? 'Crisp & Sunny';

        $matchedPerfume = Perfume::query()
            ->select('perfumes.*')
            ->selectRaw(
                '(
                    CASE WHEN scent_family = ? THEN 50 ELSE 0 END +
                    CASE WHEN weather_suitability = ? THEN 25 ELSE 0 END +
                    CASE WHEN longevity = ? THEN 12 ELSE 0 END +
                    CASE WHEN sillage = ? THEN 12 ELSE 0 END
                ) as match_score',
                [$validated['scent_family'], $weatherSuitability, $longevity, $sillage]
            )
            ->orderByDesc('match_score')
            ->inRandomOrder()
            ->first();

        $alternativePerfumes = Perfume::where('scent_family', $validated['scent_family'])
            ->where('weather_suitability', $weatherSuitability)
            ->when($matchedPerfume, fn ($query) => $query->where('perfume_id', '!=', $matchedPerfume->getKey()))
            ->inRandomOrder()
            ->limit(3)
            ->get();

        if ($alternativePerfumes->count() < 3) {
            $existingIds = $alternativePerfumes->pluck('perfume_id')
                ->when($matchedPerfume, fn ($ids) => $ids->push($matchedPerfume->getKey()))
                ->filter()
                ->values();

            $fallbackPerfumes = Perfume::when($existingIds->isNotEmpty(), fn ($query) => $query->whereNotIn('perfume_id', $existingIds))
                ->inRandomOrder()
                ->limit(3 - $alternativePerfumes->count())
                ->get();

            $alternativePerfumes = $alternativePerfumes->merge($fallbackPerfumes);
        }

        return view('recommendations', [
            'matchedPerfume' => $matchedPerfume,
            'alternativePerfumes' => $alternativePerfumes,
            'weatherContext' => [
                'computed_climate' => $weatherSuitability,
            ],
            'selectedFilters' => [
                'scent_family' => $validated['scent_family'],
                'occasion_focus' => $validated['occasion_focus'],
                'weather_suitability' => $weatherSuitability,
                'longevity' => $longevity,
                'sillage' => $sillage,
            ],
        ]);
    }

    public function match(Request $request)
    {
        return $this->generate($request);
    }

    private function resolveWeatherContext(?float $latitude, ?float $longitude): array
    {
        $weatherApiKey = config('services.google_weather.key');
        $weatherLatitude = $latitude ?? config('services.google_weather.latitude', '3.1390');
        $weatherLongitude = $longitude ?? config('services.google_weather.longitude', '101.6869');

        $weatherTemperature = 24;
        $weatherDescription = 'Weather unavailable';
        $weatherHumidity = null;

        if ($weatherApiKey) {
            $weatherResponse = Http::get('https://weather.googleapis.com/v1/currentConditions:lookup', [
                'key' => $weatherApiKey,
                'location.latitude' => $weatherLatitude,
                'location.longitude' => $weatherLongitude,
                'unitsSystem' => 'METRIC',
            ]);

            if ($weatherResponse->ok()) {
                $weatherTemperature = (float) $weatherResponse->json('temperature.degrees', 30);
                $weatherDescription = (string) $weatherResponse->json('weatherCondition.description.text', 'Current weather');
                $weatherHumidity = $weatherResponse->json('relativeHumidity');
            }
        }

        return [
            'latitude' => $weatherLatitude,
            'longitude' => $weatherLongitude,
            'temperature' => $weatherTemperature,
            'description' => $weatherDescription,
            'humidity' => $weatherHumidity,
            'computed_climate' => $this->classifyWeatherSuitability(
                $weatherTemperature,
                $weatherDescription,
                is_numeric($weatherHumidity) ? (float) $weatherHumidity : null
            ),
        ];
    }

    private function classifyWeatherSuitability(float $temperature, string $description, ?float $humidity): string
    {
        $description = strtolower($description);

        if (str_contains($description, 'rain') || str_contains($description, 'drizzle') || str_contains($description, 'shower') || str_contains($description, 'thunder')) {
            return 'Balmy Evening';
        }

        if ($temperature < 20 || str_contains($description, 'cloud') || str_contains($description, 'overcast')) {
            return 'Cold / Overcast';
        }

        if ($temperature >= 28 || ($humidity !== null && $humidity >= 70)) {
            return 'Hot / Humid';
        }

        return 'Crisp & Sunny';
    }
}
