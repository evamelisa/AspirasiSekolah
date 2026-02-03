<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

//handle auth
class AuthController extends Controller
{   
    public function showLoginForm() {
        $title = 'Login';
        return view('auth.login', compact('title'));
    }

    public function login(Request $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

        $request->session()->regenerate();
        return redirect()->route('aspirasi.index');
        }

        return back()->withErrors(['username' => 'Username atau password salah']);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}