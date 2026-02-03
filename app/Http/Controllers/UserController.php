<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
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
    // Tampil daftar user
    public function index()
    {
        // Hanya admin yang bisa akses
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $title = 'Kelola User';
        $users = User::where('role', 'user')->latest()->paginate(10);
        
        return view('user.index', compact('title', 'users'));
    }


    public function edit($id) {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'name' => 'required',
            'nis' => 'nullable',
            'kelas' => 'required',
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->nis = $request->nis;
        $user->kelas = $request->kelas;
        $user->password = $request->password;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate!');
    }

    // Hapus user
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $user = User::findOrFail($id);
        
        // Cegah hapus admin
        if ($user->role === 'admin') {
            return redirect()->route('users.index')
                ->with('error', 'Admin tidak bisa dihapus!');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}