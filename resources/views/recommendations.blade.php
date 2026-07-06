<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenity | Personal Scent Curator</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f5f0;
            color: #1f1f1f;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        
        /* Navigation Bar */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 8%;
            background: rgba(248, 245, 240, .92);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(0,0,0,.05);
        }
        .logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            letter-spacing: 8px;
        }
        .nav-links {
            display: flex;
            gap: 35px;
            font-size: 0.9rem;
            letter-spacing: 1px;
            align-items: center;
        }
        .nav-links a {
            position: relative;
            transition: 0.3s ease;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 0;
            height: 1px;
            background: #1f1f1f;
            transition: 0.3s ease;
        }
        .nav-links a:hover::after, .nav-links a.active::after {
            width: 100%;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            padding-left: 20px;
            border-left: 1px solid rgba(0,0,0,0.1);
        }
        .avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #ebe5db;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 0.85rem;
            border: 1px solid rgba(0,0,0,0.05);
            text-transform: uppercase;
        }

        /* Layout Split Container */
        .workspace-container {
            display: flex !important;
            align-items: stretch !important;
            width: 100%;
            min-height: calc(100vh - 89px);
        }

        /* Left Side: Preferences Input Panel */
        .preference-panel {
            flex: 0 0 360px !important;
            width: 360px !important;
            background: #fff;
            padding: 40px;
            border-right: 1px solid rgba(0,0,0,.05);
            position: sticky;
            top: 89px;
            height: calc(100vh - 89px);
            overflow-y: auto;
        }
        .panel-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            margin-bottom: 8px;
            line-height: 1.2;
        }
        .panel-subtitle {
            font-size: 0.85rem;
            color: #777;
            margin-bottom: 35px;
            line-height: 1.5;
        }
        .input-group {
            margin-bottom: 30px;
        }
        .group-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #888;
            margin-bottom: 12px;
            font-weight: 500;
        }
        .chip-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .chip {
            padding: 10px 18px;
            border: 1px solid #ebe5db;
            border-radius: 999px;
            background: transparent;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.3s ease;
            color: #555;
        }
        .chip:hover {
            border-color: #1f1f1f;
        }
        .chip.active {
            background: #1f1f1f;
            color: #fff;
            border-color: #1f1f1f;
        }
        .curator-submit {
            width: 100%;
            border: none;
            border-radius: 999px;
            background: #1f1f1f;
            color: #fff;
            padding: 14px 22px;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: 0.3s ease;
        }
        .curator-submit:hover {
            background: #333;
        }
        .live-weather-button {
            width: 100%;
            border: 1px solid #d9d0c4;
            border-radius: 999px;
            background: #fdfcfb;
            color: #1f1f1f;
            padding: 13px 18px;
            margin-bottom: 12px;
            font-size: 0.88rem;
            letter-spacing: 0.3px;
            cursor: pointer;
            transition: 0.3s ease;
        }
        .live-weather-button:hover {
            border-color: #1f1f1f;
            background: #f8f5f0;
        }
        .live-weather-button:disabled {
            cursor: wait;
            opacity: 0.72;
        }
        .weather-context {
            margin-bottom: 20px;
            color: #777;
            font-size: 0.88rem;
            line-height: 1.6;
        }
        .location-status {
            min-height: 20px;
            margin-bottom: 18px;
            color: #777;
            font-size: 0.8rem;
            line-height: 1.5;
        }
        .empty-match {
            background: #fff;
            border-radius: 24px;
            padding: 35px;
            color: #666;
            box-shadow: 0 10px 30px rgba(0,0,0,.03);
        }

        /* Right Side: Recommendations Results Space */
        .results-space {
            flex: 1 1 0 !important;
            min-width: 0 !important;
            margin-left: 0 !important;
            padding: 50px 6%;
            width: auto !important;
        }
        
        /* Editorial Spotlight: Top Scent Match */
        .spotlight-card {
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0,0,0,.04);
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            margin-bottom: 60px;
            border: 1px solid rgba(0,0,0,0.02);
        }
        .spotlight-img-wrapper {
            height: 480px;
            overflow: hidden;
            position: relative;
        }
        .spotlight-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s ease;
        }
        .spotlight-card:hover img {
            transform: scale(1.03);
        }
        .match-badge {
            position: absolute;
            top: 25px;
            left: 25px;
            background: #1f1f1f;
            color: #fff;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 0.8rem;
            letter-spacing: 1px;
            font-weight: 500;
        }
        .spotlight-info {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .section-headline {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #888;
            margin-bottom: 15px;
        }
        .spotlight-brand {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #888;
            margin-bottom: 5px;
        }
        .spotlight-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3rem;
            line-height: 1.1;
            margin-bottom: 15px;
        }
        .spotlight-reasoning {
            color: #666;
            line-height: 1.8;
            font-size: 0.95rem;
            margin-bottom: 25px;
            background: #fdfcfb;
            padding: 15px 20px;
            border-left: 2px solid #1f1f1f;
            border-radius: 4px;
        }
        .view-link {
            display: inline-block;
            border-bottom: 1px solid #1f1f1f;
            padding-bottom: 4px;
            font-size: 0.95rem;
            align-self: flex-start;
            transition: opacity 0.3s;
        }
        .view-link:hover {
            opacity: 0.7;
        }

        /* Secondary Recommendations Grid */
        .grid-headline {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            padding-bottom: 15px;
        }
        .rec-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }
        .rec-card {
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,.03);
            transition: transform 0.4s;
        }
        .rec-card:hover {
            transform: translateY(-8px);
        }
        .rec-card img {
            width: 100%;
            height: 320px;
            object-fit: cover;
        }
        .rec-details {
            padding: 24px;
        }
        .rec-match-rate {
            font-size: 0.75rem;
            font-weight: 600;
            color: #888;
            letter-spacing: 1px;
            margin-bottom: 4px;
            text-transform: uppercase;
        }
        .rec-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            margin-bottom: 4px;
        }
        .rec-brand {
            font-size: 0.8rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }
        .avatar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .nav-links .avatar-link::after {
            display: none;
        }

        .avatar-link:hover {
            transform: scale(1.05); /* Subtle zoom on hover */
            opacity: 0.85;          /* Slight fade luxury effect */
        }

        /* Responsive Configuration */
        @media(max-width: 768px) {
            .workspace-container {
                display: block !important;
            }
            .preference-panel {
                flex: none !important;
                width: 100% !important;
                position: relative;
                top: 0;
                height: auto;
                border-right: none;
                border-bottom: 1px solid rgba(0,0,0,.05);
                padding: 30px 6%;
            }
            .results-space {
                margin-left: 0;
                width: 100% !important;
            }
            .spotlight-card {
                grid-template-columns: 1fr;
            }
            .spotlight-img-wrapper {
                height: 350px;
            }
            .spotlight-info {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">SCENITY</div>

        <div class="nav-links">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('user.catalogue') }}">Catalogue</a>
            <a href="{{ route('recommendations') }}" class="active">Scent Curator</a>
            <a href="{{ route('library') }}">My Fragrances</a>
            
            <div class="user-profile">
                <a href="{{ route('profile') }}" class="avatar-link" title="Manage Profile">
                    <span>{{ auth()->user()->name }}</span>
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                </a>
            </div>
        </div>
    </nav>

    <div class="workspace-container">
        
        <aside class="preference-panel">
            <h1 class="panel-title">Scent Matcher</h1>
            <p class="panel-subtitle">Adjust your inputs below to dynamically regenerate your tailored fragrance compositions.</p>

            <form action="{{ route('recommendations.generate') }}" method="POST" id="curatorForm">
                @csrf
                <input type="hidden" name="scent_family" id="scentFamilyInput" value="{{ old('scent_family', $selectedFilters['scent_family'] ?? 'Woody') }}">
                <input type="hidden" name="occasion_focus" id="occasionFocusInput" value="{{ old('occasion_focus', $selectedFilters['occasion_focus'] ?? 'Evening & Gala') }}">
                <input type="hidden" name="weather_suitability" id="hidden_weather" value="{{ old('weather_suitability', $selectedFilters['weather_suitability'] ?? 'Crisp & Sunny') }}">
                
                <div class="input-group">
                    <div class="group-label">Desired Profile</div>
                    <div class="chip-grid" data-input-target="scentFamilyInput">
                        @foreach(['Woody', 'Floral', 'Fresh', 'Oriental', 'Spicy'] as $scentFamily)
                            <button type="button" class="chip {{ old('scent_family', $selectedFilters['scent_family'] ?? 'Woody') === $scentFamily ? 'active' : '' }}" data-value="{{ $scentFamily }}">
                                {{ $scentFamily }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="input-group">
                    <div class="group-label">Occasion Focus</div>
                    <div class="chip-grid" data-input-target="occasionFocusInput">
                        @foreach(['Everyday Lounge', 'Office & Professional', 'Evening & Gala'] as $occasionFocus)
                            <button type="button" class="chip {{ old('occasion_focus', $selectedFilters['occasion_focus'] ?? 'Evening & Gala') === $occasionFocus ? 'active' : '' }}" data-value="{{ $occasionFocus }}">
                                {{ $occasionFocus }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <button type="button" class="live-weather-button" id="useLiveWeatherButton">✨ Use Live Location Weather</button>
                <p class="location-status" id="locationStatus">
                    Current weather: {{ old('weather_suitability', $selectedFilters['weather_suitability'] ?? 'Crisp & Sunny') }}.
                </p>

                <button type="submit" class="curator-submit">Generate Recommendation</button>
            </form>
        </aside>

        <main class="results-space">
            
            <div class="section-headline">Your Top Scent Profile Match</div>

            @isset($weatherContext)
                <div class="weather-context">
                    Weather context resolved to <strong>{{ $weatherContext['computed_climate'] }}</strong>.
                </div>
            @endisset
            
            @if(isset($matchedPerfume) && $matchedPerfume)
                <div class="spotlight-card">
                    <div class="spotlight-img-wrapper">
                        <span class="match-badge">Live Match</span>
                        <img src="{{ $matchedPerfume->image_url ?? asset('images/default-perfume.jpg') }}" alt="{{ $matchedPerfume->name }}">
                    </div>
                    <div class="spotlight-info">
                        <div class="spotlight-brand">{{ $matchedPerfume->brand }}</div>
                        <h2 class="spotlight-title">
                            <a href="{{ route('fdetails', $matchedPerfume) }}">{{ $matchedPerfume->name }}</a>
                        </h2>
                        
                        <p class="spotlight-reasoning">
                            <strong>Why it matches:</strong>
                            The curator found the closest available match for your
                            <em>{{ $selectedFilters['scent_family'] ?? $matchedPerfume->scent_family }}</em>
                            profile with a
                            <em>{{ $selectedFilters['occasion_focus'] ?? 'balanced' }}</em>
                            occasion. Current weather resolved to
                            <em>{{ $selectedFilters['weather_suitability'] ?? $weatherContext['computed_climate'] ?? $matchedPerfume->weather_suitability }}</em>,
                            with
                            <em>{{ ucfirst($matchedPerfume->longevity) }}</em>
                            longevity and
                            <em>{{ ucfirst($matchedPerfume->sillage) }}</em>
                            sillage.
                        </p>
                        
                        <div class="spotlight-actions">
                            <a href="{{ route('fdetails', $matchedPerfume) }}" class="view-link">Explore Note Pyramid & Details</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-match">
                    @isset($matchedPerfume)
                        No exact perfume match was found for this scent family, occasion performance, and weather context combination.
                    @else
                        Choose your scent profile and occasion focus, then generate your match.
                    @endisset
                </div>
            @endif

            <h3 class="grid-headline">Alternative Matches Worth Exploring</h3>
            
            <div class="rec-grid">
                @forelse($alternativePerfumes ?? collect() as $perfume)
                    <div class="rec-card">
                        <img src="{{ $perfume->image_url ?? asset('images/default-perfume.jpg') }}" alt="{{ $perfume->name }}">
                        <div class="rec-details">
                            <div class="rec-match-rate">
                                {{ $perfume->scent_family }} / {{ ucfirst($perfume->longevity) }} / {{ ucfirst($perfume->sillage) }}
                            </div>
                            <h4 class="rec-title">
                                <a href="{{ route('fdetails', $perfume) }}">{{ $perfume->name }}</a>
                            </h4>
                            <div class="rec-brand">{{ $perfume->brand }}</div>
                            <a href="{{ route('fdetails', $perfume) }}" class="view-link" style="font-size: 0.85rem;">View Match</a>
                        </div>
                    </div>
                @empty
                    <div class="empty-match">
                        No alternative perfumes are available in the database yet.
                    </div>
                @endforelse
            </div>

        </main>
    </div>

    <script>
        const hiddenWeatherInput = document.getElementById('hidden_weather');
        const hiddenWeatherTemperatureInput = { value: '' };
        const hiddenWeatherDescriptionInput = { value: '' };
        const locationStatus = document.getElementById('locationStatus');
        const liveWeatherButton = document.getElementById('useLiveWeatherButton');

        const chips = document.querySelectorAll('.chip');
        chips.forEach(chip => {
            chip.addEventListener('click', () => {
                // Toggles sibling elements within its own layout chip group
                const siblings = chip.parentElement.querySelectorAll('.chip');
                siblings.forEach(s => s.classList.remove('active'));
                chip.classList.add('active');

                const targetInputId = chip.parentElement.dataset.inputTarget;
                if (targetInputId) {
                    document.getElementById(targetInputId).value = chip.dataset.value || chip.textContent.trim();
                }
            });
        });

        liveWeatherButton.addEventListener('click', () => {
            if (!('geolocation' in navigator)) {
                locationStatus.textContent = 'Current weather: Crisp & Sunny.';
                return;
            }

            liveWeatherButton.disabled = true;
            liveWeatherButton.textContent = 'Reading local weather...';
            locationStatus.textContent = 'Current weather: reading your location...';

            navigator.geolocation.getCurrentPosition(
                async position => {
                    try {
                        const response = await fetch('{{ route('recommendations.weather') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                latitude: position.coords.latitude,
                                longitude: position.coords.longitude,
                            }),
                        });

                        if (!response.ok) {
                            throw new Error('Weather lookup failed.');
                        }

                        const payload = await response.json();
                        hiddenWeatherInput.value = payload.weather_suitability || 'Crisp & Sunny';

                        const temperatureText = hiddenWeatherTemperatureInput.value !== ''
                            ? `, ${hiddenWeatherTemperatureInput.value}°C`
                            : '';
                        const descriptionText = hiddenWeatherDescriptionInput.value !== ''
                            ? ` (${hiddenWeatherDescriptionInput.value})`
                            : '';
                        locationStatus.textContent = `Current weather: ${hiddenWeatherInput.value} locked in!`;
                    } catch (error) {
                        hiddenWeatherInput.value = 'Crisp & Sunny';
                        locationStatus.textContent = 'Current weather: Crisp & Sunny.';
                    } finally {
                        liveWeatherButton.disabled = false;
                        liveWeatherButton.textContent = '✨ Use Live Location Weather';
                    }
                },
                () => {
                    hiddenWeatherInput.value = 'Crisp & Sunny';
                    locationStatus.textContent = 'Current weather: Crisp & Sunny.';
                    liveWeatherButton.disabled = false;
                    liveWeatherButton.textContent = '✨ Use Live Location Weather';
                },
                {
                    enableHighAccuracy: false,
                    timeout: 8000,
                    maximumAge: 600000
                }
            );
        });
    </script>
</body>
</html>
