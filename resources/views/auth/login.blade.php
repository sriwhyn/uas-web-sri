@extends('layouts.front')

@section('content')
<div class="bg-light min-vh-100 d-flex justify-content-center align-items-center py-5">
    <div class="card shadow border-0 rounded-4 p-4 p-md-5" style="max-width: 450px; width: 100%;">
        <div class="text-center mb-4">
            <i class="bi bi-person-circle fs-1 text-primary"></i>
            <h2 class="fw-bold">Masuk ke Akun</h2>
            <p class="text-muted">Gunakan akun Anda untuk mengakses portal kampus</p>
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

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email" value="{{ old('email') }}" required autofocus>
                <label for="email"><i class="bi bi-envelope-at me-2"></i>Alamat Email</label>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" required>
                <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary rounded-pill py-2">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>
            </div>
        </form>

        <div class="text-center text-muted mt-4">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                Daftar Sekarang
            </a>
        </div>
    </div>
</div>
@endsection
