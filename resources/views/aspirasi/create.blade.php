@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif      
<form method="POST" action="{{ route('aspirasi.store') }}" enctype="multipart/form-data">
@csrf
<table cellpadding="5">
    <tr>
        <td>Judul</td>
        <td><input type="text" name="title" required></td>
    </tr>
    <tr>
        <td>Kategori</td>
        <td>
        <select name="kategori_id" required>
    @foreach ($kategoriList as $kategori)
        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
    @endforeach
</select>
        </td>
    </tr>
    <tr>
        <td>Deskripsi</td>
        <td><textarea name="description" rows="4" cols="40" required></textarea></td>
    </tr>
    <tr>
        <td>Foto (Opsional)</td>
        <td><input type="file" name="photo" accept="image/*"></td>
    </tr>
    <tr>
        <td><button type="submit">Kirim</button></td>
    </tr>
</table>
</form>
@endsection