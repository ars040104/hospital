@extends('layouts.app')

@section('title', 'Вход врача')

@section('content')
<div class="container" style="max-width: 500px; margin-top: 3rem;">
    <h2>Вход врача</h2>

    <form method="POST" action="{{ route('doctor.login.post') }}">
        @csrf

        <input type="email" name="email" placeholder="Email" required class="form-control"><br>
        <input type="password" name="password" placeholder="Пароль" required class="form-control"><br>

        <button class="btn btn-primary">Войти</button>
    </form>
</div>
@endsection