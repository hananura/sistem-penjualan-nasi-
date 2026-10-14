@extends('layouts.auth')

@section('title', 'Login - Nasi Ibu')

@section('content')

<div class="login-header">
    <h2>Selamat Datang 👋</h2>
    <p>Silakan masuk untuk mengakses sistem.</p>
</div>

@if ($errors->any())
    <div class="error">
        {{ $errors->first() }}
    </div>
@endif

<form action="/login" method="POST">

    @csrf

    <div class="form-group">
        <label class="form-label">
            Email
        </label>

        <input
            type="email"
            name="email"
            class="form-control"
            value="{{ old('email') }}"
            placeholder="contoh@email.com"
            required
            autofocus
        >
    </div>

    <div class="form-group">
        <label class="form-label">
            Password
        </label>

        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Masukkan password"
            required
        >
    </div>

    <button type="submit" class="login-btn">
        Masuk ke Dashboard
    </button>

</form>

@endsection