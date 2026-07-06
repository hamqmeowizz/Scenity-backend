<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User; // FIXED: Imported the User Eloquent Model
use App\Models\Perfume;

class AuthController extends Controller
{
    // Render the login/registration view
    public function showAuthForm()
    {
        return view('auth');
    }

    // Handle user registration submission
    public function register(Request $request)
    {
        // 1. Validate form input data matching database limits
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed', 
        ]);

        // 2. FIXED: Insert user using Eloquent so Laravel Auth can track them properly
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => 'registered', 
        ]);

        // 3. Redirect to the login side with a success notification alert
        return redirect()->route('login')->with('success', 'Account created successfully! Please login.');
    }

    public function login(Request $request)
    {
        // 1. Validate the incoming data
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // 2. Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            // Redirect to their dashboard upon successful login
            return redirect()->route('dashboard');
        }

        // 3. If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    public function sendPasswordResetOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $otp = (string) random_int(100000, 999999);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $validated['email']],
            [
                'token' => Hash::make($otp),
                'created_at' => now(),
            ]
        );

        try {
            Mail::raw(
                "Your Scenity password reset OTP is {$otp}. It expires in 10 minutes.",
                function ($message) use ($validated) {
                    $message
                        ->to($validated['email'])
                        ->subject('Your Scenity Password Reset OTP');
                }
            );
        } catch (\Throwable $exception) {
            report($exception);

            DB::table('password_reset_tokens')
                ->where('email', $validated['email'])
                ->delete();

            return back()
                ->withErrors(['email' => 'We could not send the OTP right now. Please check the mail settings and try again.'])
                ->withInput();
        }

        return redirect()
            ->route('password.reset')
            ->with('success', 'We sent a 6-digit OTP to your email.')
            ->with('reset_email', $validated['email']);
    }

    public function showResetPasswordForm()
    {
        return view('reset-password');
    }

    public function resetPasswordWithOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'otp' => ['required', 'digits:6'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $validated['email'])
            ->first();

        if (
            ! $resetRecord ||
            ! Hash::check($validated['otp'], $resetRecord->token) ||
            now()->timestamp - strtotime($resetRecord->created_at) > 600
        ) {
            return back()
                ->withErrors(['otp' => 'The OTP is invalid or has expired.'])
                ->withInput($request->only('email'));
        }

        User::where('email', $validated['email'])->update([
            'password' => Hash::make($validated['password']),
        ]);

        DB::table('password_reset_tokens')
            ->where('email', $validated['email'])
            ->delete();

        return redirect()
            ->route('login')
            ->with('success', 'Your password has been reset. Please login with your new password.');
    }
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($request->user()->role !== 'admin') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withErrors(['email' => 'Access denied: administrator privileges are required.'])
                    ->onlyInput('email');
            }

            return redirect()->route('admin');
        }

        return back()
            ->withErrors(['email' => 'Access denied: invalid administrator credentials.'])
            ->onlyInput('email');
    }

    public function adminLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('adminlogin')->with('success', 'Admin session ended successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'You have been logged out successfully.');
    }

    // For public visitors (Guests)
    public function showPublicCatalogue(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $perfumes = Perfume::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('brand', 'LIKE', '%' . $search . '%')
                        ->orWhere('scent_family', 'LIKE', '%' . $search . '%')
                        ->orWhere('top_notes', 'LIKE', '%' . $search . '%')
                        ->orWhere('middle_notes', 'LIKE', '%' . $search . '%')
                        ->orWhere('base_notes', 'LIKE', '%' . $search . '%')
                        ->orWhere('longevity', 'LIKE', '%' . $search . '%')
                        ->orWhere('sillage', 'LIKE', '%' . $search . '%')
                        ->orWhere('weather_suitability', 'LIKE', '%' . $search . '%');
                });
            })
            ->orderBy('brand')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();
        
        // Renders the public guest file
        return view('catalogue', compact('perfumes', 'search')); 
    }

    // For authenticated users (Dashboard)
    public function showUserCatalogue(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $perfumes = Perfume::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('brand', 'LIKE', '%' . $search . '%')
                        ->orWhere('scent_family', 'LIKE', '%' . $search . '%')
                        ->orWhere('top_notes', 'LIKE', '%' . $search . '%')
                        ->orWhere('middle_notes', 'LIKE', '%' . $search . '%')
                        ->orWhere('base_notes', 'LIKE', '%' . $search . '%')
                        ->orWhere('longevity', 'LIKE', '%' . $search . '%')
                        ->orWhere('sillage', 'LIKE', '%' . $search . '%')
                        ->orWhere('weather_suitability', 'LIKE', '%' . $search . '%');
                });
            })
            ->orderBy('brand')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();
        
        // Renders your specific logged-in file
        return view('dashboard-catalogue', compact('perfumes', 'search')); 
    }

    public function addToLibrary(Request $request)
    {
        $validated = $request->validate([
            'perfume_id' => ['required', 'integer', 'exists:perfumes,perfume_id'],
        ]);

        $request->user()
            ->perfumes()
            ->syncWithoutDetaching([
                $validated['perfume_id'] => ['added_at' => now()],
            ]);

        return redirect()
            ->route('library')
            ->with('success', 'Fragrance added to your library.');
    }

    public function removeFromLibrary(Request $request)
    {
        $validated = $request->validate([
            'perfume_id' => ['required', 'integer', 'exists:perfumes,perfume_id'],
        ]);

        $request->user()
            ->perfumes()
            ->detach($validated['perfume_id']);

        return redirect()
            ->route('library')
            ->with('success', 'Fragrance removed from your library.');
    }

    public function showLibrary(Request $request)
    {
        $perfumes = $request->user()
            ->perfumes()
            ->orderByPivot('added_at', 'desc')
            ->get();

        return view('library', compact('perfumes'));
    }

    public function rateLibraryPerfume(Request $request)
    {
        $validated = $request->validate([
            'perfume_id' => ['required', 'integer', 'exists:perfumes,perfume_id'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ]);

        $isInLibrary = $request->user()
            ->perfumes()
            ->where('perfumes.perfume_id', $validated['perfume_id'])
            ->exists();

        abort_unless($isInLibrary, 404);

        $request->user()
            ->perfumes()
            ->updateExistingPivot($validated['perfume_id'], [
                'rating' => $validated['rating'],
            ]);

        return response()->json([
            'message' => 'Rating saved.',
            'rating' => $validated['rating'],
        ]);
    }

    public function showDashboard()
    {
        $user = Auth::user();
        $libraryPerfumes = $user->perfumes()
            ->orderByPivot('added_at', 'desc')
            ->get();
        $featuredPerfume = $libraryPerfumes->first() ?? Perfume::query()->inRandomOrder()->first();
        $libraryCount = $libraryPerfumes->count();
        $ratedPerfumes = $libraryPerfumes->filter(fn ($perfume) => (int) ($perfume->pivot->rating ?? 0) > 0);
        $ratedCount = $ratedPerfumes->count();
        $averageRating = $ratedCount > 0
            ? round($ratedPerfumes->avg(fn ($perfume) => (int) ($perfume->pivot->rating ?? 0)), 1)
            : null;
        $favoriteFamily = $libraryPerfumes
            ->groupBy('scent_family')
            ->sortByDesc(fn ($perfumes) => $perfumes->count())
            ->keys()
            ->first() ?? 'Not set';
        $recentPerfumes = $libraryPerfumes->take(3);
        $catalogueCount = Perfume::query()->count();

        return view('dashboard', compact(
            'user',
            'featuredPerfume',
            'libraryCount',
            'ratedCount',
            'averageRating',
            'favoriteFamily',
            'recentPerfumes',
            'catalogueCount'
        ));
    }
}




