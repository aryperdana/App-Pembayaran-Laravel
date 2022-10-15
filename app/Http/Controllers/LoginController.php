<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            // if ($user->level == '1') {
            //     return redirect()->intended('beranda');
            // } elseif ($user->level == '2') {
            //     return redirect()->intended(('waliKelas'));
            // }

            return redirect()->intended('home');
        }

        return view('login.view_login');
    }

    public function proses(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username Tidak Boleh Kosong',
                'password.required' => 'Password Tidak Boleh Kosong'
            ]
        );

        $credential = $request->only('username', 'password');
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // if ($user->level == '1') {
            //     return redirect()->intended('beranda');
            // } elseif ($user->level == '2') {
            //     return redirect()->intended(('wali-kelas'));
            // }

            if ($user) {
                return redirect()->intended('home');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Username atau Password Salah'
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
