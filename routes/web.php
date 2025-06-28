<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

//  LOGIN TAMPILAN DEFAULT DAN DIARAHKAN KE DASHBOARD MAS
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// REGISTER
// Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
