@extends('layouts.app')

@section('content')
<article>
    <header>
        <h2>{{ $aspirasi->title }}</h2>
    </header>

    <section>
        <p><strong>Tanggal:</strong> {{ $aspirasi->created_at->format('d F Y') }}</p>
        <p><strong>Status: </strong>{{ $aspirasi->status }}</p>
        <p><strong>Kategori:</strong> {{ $aspirasi->kategori->nama_kategori ?? '-' }}</p>
        <p><strong>Nama:</strong> {{ $aspirasi->user->name ?? 'Unknown' }}</p>        
        <p><strong>Kelas:</strong>{{ $aspirasi->user->kelas }}</p>
        <p><strong>NIS:</strong>{{ $aspirasi->user->nis }}</p>
        <hr>
        <p><strong>Deskripsi:</strong> {{ $aspirasi->description }}</p>
        
        @if ($aspirasi->photo)
            <p><strong>Foto:</strong></p>
            <img src="{{ asset('storage/' . $aspirasi->photo) }}" 
                alt="Foto Aspirasi" 
                style="max-width: 420px; height: auto; border: 1px solid #ccc; padding: 4px;">
        @endif
    </section>

        <hr>
    {{-- menampilkan balasan --}}
    
@if($aspirasi->responses->count() > 0)
    <table>
        <thead>
            <tr>
                <td colspan="2"><h3>Balasan dari Admin</h3></td>
            </tr>
        </thead>
        <tbody>
            @foreach($aspirasi->responses as $response)
                <tr>
                    <td colspan="2">
                        <p><strong>{{ $response->user->name }}</strong> 
                            <small>{{ $response->created_at->format('d M Y') }}</small>
                        </p>
                        <p>{{ $response->message }}</p>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

    @if (auth()->user()->role === 'admin' || auth()->id() == $aspirasi->user_id)
        <section>
            <h3>Kirim Balasan</h3>

            <form method="POST" action="{{ route('responses.store', $aspirasi) }}">
                @csrf
                <table>
                    <tr>
                        <td><label for="message">Pesan:</label></td>
                    </tr>
                    <tr>
                        <td>
                            <textarea id="message" name="message" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <button type="submit">Kirim Balasan</button>
                        </td>
                    </tr>
                </table>
            </form>
        </section>
    @endif

    <hr>

    {{-- Tombol Kembali --}}
    <a href="{{ route('aspirasi.index') }}" style="padding: 10px 20px; text-decoration: none;"><button>Kembali</button></a>
</article>
@endsection