<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

// ================= 1. AUTH ROUTES (PUBLIK) =================
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ================= 2. ADMIN ROUTES =================
// Hanya bisa diakses jika login DAN role = admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Asset Management
    Route::get('/assets', [AdminDashboard::class, 'assets'])->name('assets');
    Route::post('/assets', [AdminDashboard::class, 'storeAsset'])->name('assets.store');
    
    // Booking Management
    Route::get('/bookings', [AdminDashboard::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{id}/approve', [AdminDashboard::class, 'approveBooking'])->name('bookings.approve');
    Route::post('/bookings/{id}/reject', [AdminDashboard::class, 'rejectBooking'])->name('bookings.reject');
    
    // User Management
    Route::get('/users', [AdminDashboard::class, 'users'])->name('users');
});

// ================= 3. USER ROUTES =================
// Hanya bisa diakses jika login DAN role = user
Route::middleware(['auth', 'role:user'])->group(function () {
    
    // User Dashboard
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Katalog Aset
    Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');
    Route::get('/katalog/{category}', [CatalogController::class, 'index'])->name('katalog.category');
});