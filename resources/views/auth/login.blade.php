@extends('auth.app')

@section('content')
<form method="POST" action="{{ route('login.post') }}">
    @csrf
    <table cellpadding="5">
        <tr>
            <td>Username</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td align="center">
                <button type="submit">Masuk</button>
            </td>
        </tr>
    </table>
</form>
@endsection