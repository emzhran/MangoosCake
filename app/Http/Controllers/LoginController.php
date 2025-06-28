<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // INI AKSES  File BLADE LOGIN DI AUTH BANG
    }
}