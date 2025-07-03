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

    // Rute untuk menampilkan form (sudah ada)
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

    // Rute untuk memproses form (INI YANG PERLU ANDA TAMBAHKAN)
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
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

        // Kode Perbaikan
        Route::resource('data-pemesanan', AdminOrderController::class)
            ->parameters(['data-pemesanan' => 'order']) // <-- TAMBAHKAN INI
            ->except(['create', 'store']);

        Route::post('data-pemesanan/{order}/approve', [AdminOrderController::class, 'approve'])->name('data-pemesanan.approve');
        Route::post('data-pemesanan/{order}/reject', [AdminOrderController::class, 'reject'])->name('data-pemesanan.reject');
    });

    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
        
        // AKTIFKAN (UNCOMMENT) BARIS DI BAWAH INI
        Route::get('/order/create/{cake}', [CustomerOrderController::class, 'create'])->name('order.create');
      
         // Rute POST untuk menyimpan pesanan
        Route::post('/order', [CustomerOrderController::class, 'store'])->name('order.store'); // <-- KINI MENGARAH KE CustomerOrderController

        // Rute GET untuk menampilkan konfirmasi pesanan
        Route::get('/order/confirmation/{orderId}', [CustomerOrderController::class, 'showOrderConfirmation'])->name('order.confirmation'); // <-- KINI MENGARAH KE CustomerOrderController
        
        // Route::post('/order', [CustomerOrderController::class, 'store'])->name('order.store');
        // Route::get('/my-orders', [CustomerOrderController::class, 'index'])->name('orders.index');

        Route::post('/order', [CustomerOrderController::class, 'store'])->name('order.store');
    });
});
