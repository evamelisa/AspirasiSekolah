@extends('layouts.app')

@section('content')
<tr>

    @if ($errors->any())
        <td class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </td>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <table class="w-full border-collapse">
            <tr>
                <td>Username</td>
                <td class="py-2">
                    <input type="text" name="username"
                        value="{{ old('username', $user->username) }}" required>
                </td>
            </tr>

            <tr>
                <td>Nama</td>
                <td class="py-2">
                    <input type="text" name="name"
                        value="{{ old('name', $user->name) }}" required>
                </td>
            </tr>
            <tr>
                <td>NIS</td>
                <td class="py-2">
                    <input type="text" name="nis"
                        value="{{ old('nis', $user->nis) }}" required>
                </td>
            </tr>

            <tr>
                <td>Kelas</td>
                <td class="py-2">
                    <input type="text" name="kelas"
                        value="{{ old('kelas', $user->kelas) }}" required>
                </td>
            </tr>

            <tr>
                <td>Password</td>
                <td class="py-2">
                    <input type="text" name="password"
                        value="{{ old('password') }}" required>
                </td>
            </tr>
            <tr>
                <td>Konfirmasi Pssword</td>
                <td class="py-2">
                    <input type="text" name="password"
                        value="{{ old('password_confirmation') }}" required>
                </td>
            </tr>

            <tr>
                <td></td>
                <td class="pt-4">
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Update
                    </button>
                </td>
            </tr>
        </table>
    </form>
</tr>
@endsection