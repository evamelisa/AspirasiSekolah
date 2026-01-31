@extends('layouts.app')

@section('content')
<p>
    <a href="{{ route('register') }}"><button>Tambah User Baru</button></a>
</p>

{{-- alert success --}}
@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

{{-- alert error --}}
@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

{{-- tabel user --}}
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $index => $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->kelas }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}"><button>Edit</button></a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user {{ $user->name }}?')" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Belum ada user terdaftar</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection