<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // 🔑 Cek hardcode
        if ($username === 'agan' && $password === '1234') {
            Session::put('admin_logged_in', true);
            return redirect('/dashboard');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function dashboard()
    {
        if (!Session::has('admin_logged_in') || !Session::get('admin_logged_in')) {
            return redirect('/login')->with('error', 'Silakan login dulu!');
        }

        return view('dashboard');
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect('/');
    }
}