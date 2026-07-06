<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $perfumes = Perfume::paginate(20);
        $registeredUsers = User::where('role', 'registered')->get();
        $totalUsers = $registeredUsers->count();

        return view('admin', compact('perfumes', 'registeredUsers', 'totalUsers'));
    }

    public function storePerfume(Request $request)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $validated = $this->validatePerfume($request);
        $duplicatePerfume = Perfume::query()
            ->whereRaw('LOWER(brand) = ?', [mb_strtolower(trim($validated['brand']))])
            ->whereRaw('LOWER(name) = ?', [mb_strtolower(trim($validated['name']))])
            ->first();

        if ($duplicatePerfume) {
            return back()
                ->withInput()
                ->with('duplicate_perfume', [
                    'name' => $duplicatePerfume->name,
                    'brand' => $duplicatePerfume->brand,
                    'scent_family' => $duplicatePerfume->scent_family,
                ]);
        }

        Perfume::create($validated);

        return back()->with('success', 'Fragrance entry created successfully.');
    }

    public function updatePerfume(Request $request, Perfume $perfume)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $perfume->update($this->validatePerfume($request));

        return back()->with('success', 'Fragrance entry updated successfully.');
    }

    public function destroyPerfume(Perfume $perfume)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $perfume->delete();

        return back()->with('success', 'Fragrance entry deleted successfully.');
    }

    public function destroyUser(User $user)
    {
        abort_unless(auth()->user()->role === 'admin', 403);
        abort_if($user->role !== 'registered', 403);

        $user->delete();

        return back()->with('success', 'Registered user account deleted successfully.');
    }

    private function validatePerfume(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'scent_family' => ['required', Rule::in(['Woody', 'Floral', 'Fresh', 'Oriental', 'Spicy'])],
            'top_notes' => ['required', 'string', 'max:255'],
            'middle_notes' => ['required', 'string', 'max:255'],
            'base_notes' => ['required', 'string', 'max:255'],
            'longevity' => ['required', Rule::in(['weak', 'moderate', 'strong'])],
            'sillage' => ['required', Rule::in(['soft', 'moderate', 'heavy'])],
            'weather_suitability' => ['required', Rule::in(['Crisp & Sunny', 'Cold / Overcast', 'Hot / Humid', 'Balmy Evening'])],
            'image_url' => ['nullable', 'url', 'max:2048'],
        ]);
    }
}

