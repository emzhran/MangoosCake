<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // INI AKSES  File BLADE LOGIN DI AUTH BANG
    }

    public function login(Request $request)
    {
        // Langsung redirect ngga pakai validasi
        return redirect()->route('dashboard');
    }
}