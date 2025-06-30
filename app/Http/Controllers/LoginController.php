<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- WAJIB di-import
use Illuminate\Http\RedirectResponse; // <-- WAJIB di-import

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses login.
     */
    public function login(Request $request): RedirectResponse
    {
        // 1. Validasi input dari form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba untuk mengotentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Jika berhasil, regenerate session untuk keamanan
            $request->session()->regenerate();

            // 3. Cek peran pengguna dan arahkan
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboardAdmin'));
            }

            if ($user->role === 'user') {
                return redirect()->intended(route('user.dashboardAdmin'));
            }

            // Fallback jika peran tidak terdefinisi (seharusnya tidak terjadi)
            return redirect('/');
        }

        // 4. Jika otentikasi gagal
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}