<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\AssetController; 
use App\Http\Controllers\BorrowingController; 


// ================= 1. AUTH ROUTES (PUBLIK) =================
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// REGISTER ROUTES
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Google OAuth Routes
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// ================= 2. ADMIN ROUTES =================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // ✅ ASSET MANAGEMENT ROUTES (Gunakan AssetController)
    Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
    Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
    Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
    Route::get('/assets/{asset}/edit', [AssetController::class, 'edit'])->name('assets.edit');
    Route::put('/assets/{asset}', [AssetController::class, 'update'])->name('assets.update');
    Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy');
    
    // ✅ TAMBAHKAN ROUTE DUMMY INI (sementara)
    Route::get('/reports', function() {
        return back()->with('info', 'Fitur laporan sedang dalam pengembangan.');
    })->name('reports');
    
    // Booking Management
    Route::get('/bookings', [AdminDashboard::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{id}/approve', [AdminDashboard::class, 'approveBooking'])->name('bookings.approve');
    Route::post('/bookings/{id}/reject', [AdminDashboard::class, 'rejectBooking'])->name('bookings.reject');
    
    // User Management
    Route::get('/users', [AdminDashboard::class, 'users'])->name('users');
});

// ================= 3. USER ROUTES =================
Route::middleware(['auth', 'role:user'])->group(function () {
    
    // ✅ User Dashboard
    Route::get('/user/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])
        ->name('user.dashboard');

    // Katalog Aset Routes
    Route::get('/katalog', [\App\Http\Controllers\CatalogController::class, 'index'])->name('katalog');
    Route::get('/katalog/{category}', [\App\Http\Controllers\CatalogController::class, 'category'])->name('katalog.category');

    // ✅ BORROWING ROUTES (PLACEHOLDER - Tidak Error)
    Route::get('/ajukan-peminjaman/{assetId}', function($assetId) {
        // Tampilkan pesan "Coming Soon" atau redirect ke katalog
        return redirect()->route('katalog')->with('info', 'Fitur peminjaman sedang dalam pengembangan. Silakan pilih aset dari katalog.');
    })->name('user.borrowing.create');
});