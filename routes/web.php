<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// REGISTER

// Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');