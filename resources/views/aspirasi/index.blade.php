@extends('layouts.app')

@section('content')

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
                @if(Auth::user()->role == 'admin')
            <th>Nama</th>
            <th>NIS</th>
            <th>Kelas</th>
                @endif
            <th>Judul</th>
            <th>Kategori</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($aspirasi as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                @if(Auth::user()->role == 'admin')
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->user->nis }}</td>
            <td>{{ $item->user->kelas }}</td>
                @endif
            <td><a href="{{ route('aspirasi.show', $item->id) }}"> {{ $item->title }}</a></td>
            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
            <td>
                @if(Auth::user()->role == 'admin')
                    <form method="POST" action="{{ route('aspirasi.update', $item->id) }}">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()">
                            <option value="menunggu" {{ $item->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                @else
                    {{ $item->status }}
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
