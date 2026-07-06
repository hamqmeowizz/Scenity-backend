<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfumeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecommendationController;

// --- GUEST / PUBLIC ROUTES (Accessible by Everyone) ---
Route::get('/', function () {
    return view('index');
})->name('index');

// Public catalog fallback
Route::get('/catalogue', [AuthController::class, 'showPublicCatalogue'])->name('catalogue');

Route::get('/about', function () {
    return view('about-us');
})->name('about');

// Authentication Forms & Actions
Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetOtp'])->name('password.email');
Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPasswordWithOtp'])->name('password.update');
Route::get('/adminlogin', function () {
    return view('adminlogin');
})->name('adminlogin');
Route::post('/adminlogin', [AuthController::class, 'adminLogin'])->name('admin.login.submit');


// --- PROTECTED USER ROUTES (Must be logged in) ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard securely passes through your controller
    Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Your User Catalogue Route
    Route::get('/dashboard/catalogue', [AuthController::class, 'showUserCatalogue'])->name('user.catalogue');

    Route::get('/fdetails/{perfume?}', [PerfumeController::class, 'show'])->name('fdetails');

    // Add a perfume to the authenticated user's personal shelf
    Route::post('/library/add', [AuthController::class, 'addToLibrary'])->name('library.add');
    Route::delete('/library/remove', [AuthController::class, 'removeFromLibrary'])->name('library.remove');
    Route::post('/library/rate', [AuthController::class, 'rateLibraryPerfume'])->name('library.rate');

    // Other protected user views
    Route::get('/library', [AuthController::class, 'showLibrary'])->name('library');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profileindv', function () {
        return view('profileindv');
    })->name('profileindv');

    Route::get('/recommendations', [RecommendationController::class, 'index'])->name('recommendations');
    Route::post('/recommendations/generate', [RecommendationController::class, 'generate'])->name('recommendations.generate');
    Route::post('/recommendations/weather', [RecommendationController::class, 'detectLocalWeather'])->name('recommendations.weather');
    Route::post('/recommendations/match', [RecommendationController::class, 'match'])->name('recommendations.match');
});


// --- ADMIN SYSTEM ROUTES ---
Route::get('/admin', [AdminController::class, 'index'])->middleware('auth')->name('admin');
Route::post('/admin/perfumes', [AdminController::class, 'storePerfume'])->middleware('auth')->name('admin.perfumes.store');
Route::put('/admin/perfumes/{perfume}', [AdminController::class, 'updatePerfume'])->middleware('auth')->name('admin.perfumes.update');
Route::delete('/admin/perfumes/{perfume}', [AdminController::class, 'destroyPerfume'])->middleware('auth')->name('admin.perfumes.destroy');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->middleware('auth')->name('admin.users.destroy');
Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->middleware('auth')->name('admin.logout');

