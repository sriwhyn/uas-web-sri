<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengumuman - Webinar Event Sri</title>
    <!-- Sertakan Bootstrap CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Sertakan Bootstrap Icons dari CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Kustom Minimal untuk Padding Header Tetap -->
    <style>
        /* CSS ini diperlukan agar konten tidak tertutup oleh navbar fixed-top. */
        /* Jika Anda benar-benar tidak menginginkan tag <style> sama sekali, */
        /* maka header tidak akan bisa menjadi tetap. */
        body {
            padding-top: 5rem; /* Sesuaikan dengan tinggi navbar Anda */
            background-color: var(--bs-gray-100); /* Warna latar belakang abu-abu terang dari Bootstrap */
        }
        .rounded {
            border-radius: var(--bs-border-radius) !important; /* Memastikan rounded default Bootstrap */
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar Admin (Contoh) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAdmin" aria-controls="navbarNavAdmin" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAdmin">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Daftar Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Edit Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @extends('layouts.admin')

    @section('content')
    <div class="py-5 px-4">
        <div class="container">
            <div class="card p-4 p-md-5 rounded-3 shadow-lg mx-auto" style="max-width: 600px; width: 100%;">
                <div class="text-center mb-4">
                    <h2 class="h3 fw-bold text-dark mb-2">
                        Edit Pengumuman
                    </h2>
                    <p class="text-muted">
                        Perbarui detail pengumuman di bawah ini.
                    </p>
                </div>

                <form class="mt-4" action="{{ route('admin.pengumuman.update', $pengumuman->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Metode PUT untuk update --}}

                    <div class="mb-3">
                        <!-- Judul -->
                        <label for="judul" class="form-label text-muted">Judul Pengumuman</label>
                        <input id="judul" name="judul" type="text" autocomplete="off" required
                            class="form-control rounded @error('judul') is-invalid @enderror"
                            placeholder="Masukkan judul pengumuman" value="{{ old('judul', $pengumuman->judul) }}">
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <!-- Isi -->
                        <label for="isi" class="form-label text-muted">Isi Pengumuman</label>
                        <textarea id="isi" name="isi" rows="6" required
                            class="form-control rounded @error('isi') is-invalid @enderror"
                            placeholder="Masukkan isi pengumuman lengkap">{{ old('isi', $pengumuman->isi) }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('admin.pengumuman.index') }}"
                            class="btn btn-secondary rounded px-4 me-2">
                            Batal
                        </a>
                        <button type="submit"
                            class="btn btn-primary rounded px-4">
                            Perbarui Pengumuman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    <!-- Sertakan Bootstrap JS dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
