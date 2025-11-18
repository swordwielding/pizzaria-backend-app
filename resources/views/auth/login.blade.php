@extends('layouts.app')
@section('content')

    <form action="{{ route('auth.login') }}" method="POST" class="product-form">
        @csrf

        <label>Логин:</label>
        <input type="text" name="name" id="name" required>

        <label>Пароль:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Войти</button>
    </form>

@endsection