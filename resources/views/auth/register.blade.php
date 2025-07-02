@extends('layouts.front')

@section('content')
<div class="bg-light min-vh-100 d-flex justify-content-center align-items-center py-5">
    <div class="card shadow border-0 rounded-4 p-4 p-md-5" style="max-width: 500px; width: 100%;">
        <div class="text-center mb-4">
            <i class="bi bi-person-plus-fill fs-1 text-primary"></i>
            <h2 class="fw-bold">Daftar Akun Baru</h2>
            <p class="text-muted">Isi form di bawah untuk membuat akun Anda.</p>
        </div>

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-x-circle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i> Terjadi kesalahan:
            <ul class="mb-0 ps-3 mt-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                <label for="name"><i class="bi bi-person-fill me-2"></i>Nama Lengkap</label>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Alamat Email" value="{{ old('email') }}" required>
                <label for="email"><i class="bi bi-envelope-at me-2"></i>Alamat Email</label>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" required>
                <label for="password"><i class="bi bi-lock-fill me-2"></i>Password</label>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password_confirmation" class="form-control"
                    placeholder="Konfirmasi Password" required>
                <label for="password_confirmation"><i class="bi bi-shield-lock-fill me-2"></i>Konfirmasi Password</label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary rounded-pill py-2">
                    <i class="bi bi-person-plus me-2"></i>Daftar
                </button>
            </div>
        </form>

        <div class="text-center text-muted mt-3">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-decoration-none text-primary">Masuk Sekarang</a>
        </div>
    </div>
</div>
@endsection
