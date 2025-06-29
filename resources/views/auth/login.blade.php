@extends('layouts.front')

@section('content')
<div class="min-h-screen bg-gray-100 d-flex align-items-center justify-content-center py-5 px-4">
    <div class="card p-4 p-md-5 rounded-3 shadow-lg mx-auto" style="max-width: 450px; width: 100%;">
        <div class="text-center mb-4">
            <h2 class="h3 fw-bold text-dark mb-2">
                Masuk ke Akun Anda
            </h2>
            <p class="text-muted">
                Silakan masukkan kredensial Anda untuk melanjutkan.
            </p>
        </div>

        {{-- Flash Messages for login errors --}}
        @if (session('error'))
            <div class="alert alert-danger px-4 py-3 rounded-3 mb-4" role="alert">
                <strong class="fw-bold">Gagal Login!</strong>
                <span class="d-block d-sm-inline">{{ session('error') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger px-4 py-3 rounded-3 mb-4" role="alert">
                <strong class="fw-bold">Validasi Gagal!</strong>
                <ul class="mt-2 mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-4" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <!-- Email Input -->
                <div class="form-floating">
                    <input id="email-address" name="email" type="email" autocomplete="email" required
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Alamat Email" value="{{ old('email') }}">
                    <label for="email-address">Alamat Email</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <!-- Password Input -->
                <div class="form-floating">
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password">
                    <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input id="remember-me" name="remember" type="checkbox"
                        class="form-check-input">
                    <label for="remember-me" class="form-check-label text-muted">
                        Ingat Saya
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="text-decoration-none text-primary">
                        Lupa password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="btn btn-primary w-100 py-2 rounded-pill d-flex align-items-center justify-content-center">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Masuk
                </button>
            </div>
        </form>

        <div class="text-center text-muted mt-4">
            Belum punya akun?
            <a href="#" class="text-decoration-none text-primary">
                Daftar Sekarang
            </a>
        </div>
    </div>
</div>
@endsection
