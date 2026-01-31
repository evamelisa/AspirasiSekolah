<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi Sekolah</title>
</head>
<body>

<header>
    <h1>Aspirasi Sekolah</h1>
    <hr>

    <nav style="display: flex; align-items: center; gap: 10px;">
    <a href="{{ route('aspirasi.index') }}">Home</a>
    
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('users.index') }}">Kelola User</a> 
    @else
        <a href="{{ route('aspirasi.create') }}">Buat Aspirasi</a>
    @endif
    
    <span>Hai, {{ auth()->user()->name }}</span>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>

    <hr>
    <h2>{{ $title ?? '' }}</h2>
</header>

<main>
    @yield('content')
</main>
</body>
</html>
