<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
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