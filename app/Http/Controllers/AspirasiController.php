<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Aspirasi;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function index()
    {
        $title = 'Daftar Aspirasi';

    $query = Aspirasi::orderByRaw("CASE status
    WHEN 'menunggu' THEN 1
    WHEN 'diproses' THEN 2
    WHEN 'selesai' THEN 3
END")->orderBy('created_at', 'desc');

if (Auth::user()->role !== 'admin') {
    $query->where('user_id', Auth::id());
}

$aspirasi = $query->get();


    return view('aspirasi.index', compact('title', 'aspirasi'));
    }

    public function create()
    {
        $title = 'Tambah Aspirasi';
        $kategoriList = Kategori::all();
        return view('aspirasi.create', compact('title', 'kategoriList'));

        
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'kategori_id' => 'required',
        'description' => 'required',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
    ]);

    $photoPath = null;

    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('aspirasi', 'public');
    }

    Aspirasi::create([
        'user_id' => Auth::id(),
        'kategori_id' => $request->kategori_id, 
        'title' => $request->title,
        'description' => $request->description,
        'photo' => $photoPath,
    ]);

    return redirect()->route('aspirasi.index')
        ->with('success', 'Aspirasi berhasil dibuat.');
}

    public function show(string $id)
    {
        $title = 'Detail Aspirasi';
        $aspirasi = Aspirasi::findOrFail($id);

        if (Auth::user()->role == 'user' && $aspirasi->user_id != Auth::id()) {
            abort(403);
        }

        return view('aspirasi.show', compact('title', 'aspirasi'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);

        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $aspirasi->update(['status' => $request->status]);

        return redirect()->route('aspirasi.index')
            ->with('success', 'Status aspirasi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $aspirasi = Aspirasi::findOrFail($id);

        if (Auth::user()->role == 'user' && $aspirasi->user_id != Auth::id()) {
            abort(403);
        }

        $aspirasi->delete();

        return redirect()->route('aspirasi.index')
            ->with('success', 'Aspirasi berhasil dihapus.');
    }
}