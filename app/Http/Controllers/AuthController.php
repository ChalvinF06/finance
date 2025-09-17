<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $validUsers = [
        'chalvin' => '210203',
        'ajian_sakti' => 'matahari'
    ];

    public function showLogin()
    {
        if (session('authenticated')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;

        if (isset($this->validUsers[$username]) && $this->validUsers[$username] === $password) {
            session(['authenticated' => true, 'username' => $username]);
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['login' => 'Username atau password salah!']);
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}