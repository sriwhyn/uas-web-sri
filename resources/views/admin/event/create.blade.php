<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event Baru - Webinar Event Sri</title>
    <!-- Sertakan Bootstrap CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Sertakan Bootstrap Icons dari CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Area untuk CSS Kustom (Dikosongkan sepenuhnya sesuai permintaan Anda) -->
    <style>
        /* Area ini sengaja dikosongkan. Semua gaya akan berasal dari Bootstrap. */
        body {
            background-color: var(--bs-gray-100); /* Menggunakan variabel CSS Bootstrap untuk warna latar belakang */
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
                        <a class="nav-link" href="#">Daftar Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Tambah Event</a>
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
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h4 mb-0">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Event Baru
                        </h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <!-- Judul -->
                                <div class="col-12 col-md-6">
                                    <label for="judul" class="form-label">Judul Event</label>
                                    <input id="judul" name="judul" type="text" autocomplete="off" required
                                        class="form-control @error('judul') is-invalid @enderror"
                                        placeholder="Masukkan judul event" value="{{ old('judul') }}">
                                    @error('judul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div class="col-12 col-md-6">
                                    <label for="kategori_id" class="form-label">Kategori</label>
                                    <select id="kategori_id" name="kategori_id" required
                                        class="form-select @error('kategori_id') is-invalid @enderror">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategori as $kat)
                                            <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                                {{ $kat->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Tanggal -->
                                <div class="col-12 col-md-6">
                                    <label for="tanggal" class="form-label">Tanggal Event</label>
                                    <input id="tanggal" name="tanggal" type="date" required
                                        class="form-control @error('tanggal') is-invalid @enderror"
                                        value="{{ old('tanggal') }}">
                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Lokasi -->
                                <div class="col-12 col-md-6">
                                    <label for="lokasi" class="form-label">Lokasi Event</label>
                                    <input id="lokasi" name="lokasi" type="text" autocomplete="off" required
                                        class="form-control @error('lokasi') is-invalid @enderror"
                                        placeholder="Masukkan lokasi event" value="{{ old('lokasi') }}">
                                    @error('lokasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Kuota -->
                                <div class="col-12 col-md-6">
                                    <label for="kuota" class="form-label">Kuota (Opsional)</label>
                                    <input id="kuota" name="kuota" type="number" min="1"
                                        class="form-control @error('kuota') is-invalid @enderror"
                                        placeholder="Masukkan kuota peserta" value="{{ old('kuota') }}">
                                    @error('kuota')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Gambar -->
                                <div class="col-12">
                                    <label for="gambar" class="form-label">Gambar Event (Opsional)</label>
                                    <input id="gambar" name="gambar" type="file" accept="image/*"
                                        class="form-control @error('gambar') is-invalid @enderror">
                                    @error('gambar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Deskripsi -->
                                <div class="col-12">
                                    <label for="deskripsi" class="form-label">Deskripsi Event</label>
                                    <textarea id="deskripsi" name="deskripsi" rows="6" required
                                        class="form-control @error('deskripsi') is-invalid @enderror"
                                        placeholder="Masukkan deskripsi lengkap event">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('admin.event.index') }}" class="btn btn-secondary me-2">
                                    <i class="bi bi-arrow-left me-1"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i>Simpan Event
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <!-- Sertakan Bootstrap JS dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
