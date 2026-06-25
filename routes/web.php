<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\AssetController; 
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
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
    
    // Asset Management Routes
    Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
    Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
    Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
    Route::get('/assets/{asset}/edit', [AssetController::class, 'edit'])->name('assets.edit');
    Route::put('/assets/{asset}', [AssetController::class, 'update'])->name('assets.update');
    Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy');
    
    // Borrowing Management Routes (Admin)
    Route::get('/borrowings', [AdminBorrowingController::class, 'index'])->name('borrowings');
    Route::post('/borrowings/{id}/approve', [AdminBorrowingController::class, 'approve'])->name('borrowings.approve');
    Route::post('/borrowings/{id}/reject', [AdminBorrowingController::class, 'reject'])->name('borrowings.reject');
    Route::post('/borrowings/{id}/borrowed', [AdminBorrowingController::class, 'markAsBorrowed'])->name('borrowings.borrowed');
    Route::post('/borrowings/{id}/returned', [AdminBorrowingController::class, 'markAsReturned'])->name('borrowings.returned');
    
    // User Management
    Route::get('/users', [AdminDashboard::class, 'users'])->name('users');
    
    // Reports (Placeholder)
    Route::get('/reports', function() {
        return view('admin.reports');
    })->name('reports');
});

// ================= 3. USER ROUTES =================
Route::middleware(['auth', 'role:user'])->group(function () {
    
    // User Dashboard
    Route::get('/user/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])
        ->name('user.dashboard');

    // Katalog Aset Routes
    Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');
    Route::get('/katalog/{category}', [CatalogController::class, 'category'])->name('katalog.category');

    // Borrowing Routes (User) - HANYA 1 SET, TIDAK ADA DUPLIKASI
    Route::get('/ajukan-peminjaman/{asset}', [BorrowingController::class, 'create'])
        ->name('user.borrowing.create');
    Route::post('/ajukan-peminjaman/{asset}/confirm', [BorrowingController::class, 'confirm'])
        ->name('user.borrowing.confirm');
    Route::post('/ajukan-peminjaman/{asset}/store', [BorrowingController::class, 'store'])
        ->name('user.borrowing.store');
    Route::get('/riwayat-peminjaman', [BorrowingController::class, 'history'])
        ->name('user.borrowing.history');
});