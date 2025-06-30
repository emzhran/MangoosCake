<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// --- 1. TAMBAHKAN USE STATEMENT INI ---
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) { // Hapus ': void' agar bisa me-return
        // Daftarkan alias middleware Anda di sini
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class, 
        ]);

        // --- 2. TAMBAHKAN BLOK INI UNTUK MEMPERBAIKI REDIRECT LOOP ---
        $middleware->redirectGuestsTo(function () {
            // Cek apakah pengguna sudah login
            if (Auth::check()) {
                $user = Auth::user();

                // Jika rolenya admin, alihkan ke dasbor admin
                if ($user->role === 'admin') {
                    return route('admin.dashboard');
                }

                // Jika rolenya customer, alihkan ke dasbor customer
                if ($user->role === 'customer') {
                    return route('customer.dashboard');
                }
            }

            // Jika tidak ada kondisi yang cocok, kembali ke halaman login
            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) { // Hapus ': void'
        //
    })->create();
