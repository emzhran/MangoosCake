<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CakeController;
use App\Http\Controllers\User\CustomerDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\User\CustomerOrderController;

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
        // Rute untuk Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Route untuk CRUD Kue (Data Kue)
        Route::resource('datakue', CakeController::class);

        Route::resource('data-pemesanan', AdminOrderController::class)->except(['create', 'store']);
    });

    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
        
        // Route::get('/order/create/{cake}', [CustomerOrderController::class, 'create'])->name('order.create');
        // Route::post('/order', [CustomerOrderController::class, 'store'])->name('order.store');
        // Route::get('/my-orders', [CustomerOrderController::class, 'index'])->name('orders.index');
    });
});
