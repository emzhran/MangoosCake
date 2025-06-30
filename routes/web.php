<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
// Import Controller untuk dasbor
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\CustomerDashboardController;

// --- GRUP UNTUK PENGGUNA YANG BELUM LOGIN (GUEST) ---
Route::middleware('guest')->group(function () {
    // Menampilkan form login
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    // Memproses data login
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    // Menampilkan form registrasi
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    // Memproses data registrasi (jika Anda butuh)
    // Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});


// --- GRUP UNTUK PENGGUNA YANG SUDAH LOGIN (AUTH) ---
Route::middleware('auth')->group(function () {
    // Route untuk logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Grup untuk dasbor Admin
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboardAdmin', [AdminDashboardController::class, 'index'])->name('admin.dashboardAdmin');
    });

    // Grup untuk dasbor User
    Route::middleware('role:customer')->prefix('customer')->group(function () {
        Route::get('/dashboardCustomer', [CustomerDashboardController::class, 'index'])->name('customer.dashboardCustomer');
    });
});