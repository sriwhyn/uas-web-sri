@extends('layouts.front')

@section('content')
<div class="bg-light min-vh-100 d-flex justify-content-center align-items-center py-5">
    <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5" style="max-width: 480px; width: 100%;">
        <div class="text-center mb-4">
            <div class="bg-primary bg-gradient rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                <i class="bi bi-person-fill text-white fs-3"></i>
            </div>
            <h3 class="fw-bold text-primary">Masuk ke Akun</h3>
            <p class="text-muted small">Gunakan akun Anda untuk mengakses Portal Informasi Kampus PNP</p>
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
                <ul class="mb-0 ps-3 mt-2 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email" value="{{ old('email') }}" required autofocus>
                <label for="email"><i class="bi bi-envelope-at me-2"></i>Email</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" required>
                <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label small" for="remember">
                    Ingat saya
                </label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary rounded-pill py-2">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>
            </div>
        </form>

        <div class="text-center text-muted mt-4 small">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-decoration-none fw-semibold text-primary">
                Daftar sekarang
            </a>
        </div>
    </div>
</div>
@endsection
