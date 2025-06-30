<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
// Controller yang sudah ada
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\CustomerDashboardController;

// --- GRUP UNTUK PENGGUNA YANG BELUM LOGIN (GUEST) ---
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
});


// --- GRUP UNTUK PENGGUNA YANG SUDAH LOGIN (AUTH) ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // --- GRUP UNTUK ADMIN ---
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Rute untuk Dashboard (ini sudah benar karena Controller-nya ada)
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Rute untuk Data Kue (SOLUSI SEMENTARA)
        // Gunakan fungsi langsung untuk menampilkan view, tanpa perlu Controller.
        Route::get('/data-kue', function () {
            return view('admin.dataKue'); // Pastikan file view ini ada
        })->name('datakue');

        // Rute untuk Data Pesanan (SOLUSI SEMENTARA)
        // Gunakan fungsi langsung untuk menampilkan view, tanpa perlu Controller.
        Route::get('/data-pesanan', function () {
            return view('admin.dataPesanan'); // Pastikan file view ini ada
        })->name('datapesanan');
    });

    // --- GRUP UNTUK CUSTOMER ---
    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
    });
});
