<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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

    public function showRegisterForm() {
        $title = 'Daftar User Baru';
        return view('auth.register', compact('title'));
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username|max:255',
            'nis' => 'required|unique:users,nis|max:20',
            'password' => 'required|min:6',

        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'nis' => $request->nis,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        //Redirect ke halaman aspirasi dengan pesan sukses
        return redirect()->route('aspirasi.index')->with('success', 'User"'. $user->name .'" berhasil didaftarkan.');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}