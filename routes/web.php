<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CatalogController;

// ================= AUTH ROUTES =================
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ================= PROTECTED ROUTES =================
Route::middleware(['auth'])->group(function () {
    
    // User Dashboard
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // ================= KATALOG ROUTES =================
    Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');
    Route::get('/katalog/{category}', [CatalogController::class, 'index'])->name('katalog.category');
    
});