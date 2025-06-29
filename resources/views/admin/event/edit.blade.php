<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - Webinar Event Sri</title>
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
                        <a class="nav-link active" aria-current="page" href="#">Edit Event</a>
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
    <div class="min-vh-100 d-flex align-items-center justify-content-center py-5 px-4" style="padding-top: 5rem !important;">
        <div class="container">
            <div class="card p-4 p-md-5 rounded-3 shadow-lg mx-auto" style="max-width: 900px; width: 100%;">
                <div class="text-center mb-4">
                    <h2 class="h3 fw-bold text-dark mb-2">
                        Edit Event
                    </h2>
                    <p class="text-muted">
                        Perbarui detail event di bawah ini.
                    </p>
                </div>

                {{-- Form untuk update event --}}
                <form class="mt-4" action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Metode PUT untuk update --}}

                    <div class="row g-4">
                        <!-- Judul -->
                        <div class="col-12 col-md-6">
                            <label for="judul" class="form-label text-muted">Judul Event</label>
                            <input id="judul" name="judul" type="text" autocomplete="off" required
                                class="form-control rounded @error('judul') is-invalid @enderror"
                                placeholder="Masukkan judul event" value="{{ old('judul', $event->judul) }}">
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="col-12 col-md-6">
                            <label for="kategori_id" class="form-label text-muted">Kategori</label>
                            <select id="kategori_id" name="kategori_id" required
                                class="form-select rounded @error('kategori_id') is-invalid @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id }}" {{ old('kategori_id', $event->kategori_id) == $kat->id ? 'selected' : '' }}>
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
                            <label for="tanggal" class="form-label text-muted">Tanggal Event</label>
                            <input id="tanggal" name="tanggal" type="date" required
                                class="form-control rounded @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal', $event->tanggal ? $event->tanggal->format('Y-m-d') : '') }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="col-12 col-md-6">
                            <label for="lokasi" class="form-label text-muted">Lokasi Event</label>
                            <input id="lokasi" name="lokasi" type="text" autocomplete="off" required
                                class="form-control rounded @error('lokasi') is-invalid @enderror"
                                placeholder="Masukkan lokasi event" value="{{ old('lokasi', $event->lokasi) }}">
                            @error('lokasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="col-12">
                            <label for="gambar" class="form-label text-muted">Gambar Event (Biarkan kosong jika tidak ingin mengubah)</label>
                            <input id="gambar" name="gambar" type="file"
                                class="form-control @error('gambar') is-invalid @enderror">
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            @if($event->gambar)
                                <div class="mt-3">
                                    <p class="text-muted small mb-1">Gambar Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $event->gambar) }}" alt="Gambar Event" class="img-thumbnail rounded shadow-sm" style="max-width: 200px;">
                                </div>
                            @endif
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-12">
                            <label for="deskripsi" class="form-label text-muted">Deskripsi Event</label>
                            <textarea id="deskripsi" name="deskripsi" rows="6" required
                                class="form-control rounded @error('deskripsi') is-invalid @enderror"
                                placeholder="Masukkan deskripsi lengkap event">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('admin.event.index') }}"
                            class="btn btn-secondary rounded px-4 me-2">
                            Batal
                        </a>
                        <button type="submit"
                            class="btn btn-primary rounded px-4">
                            Perbarui Event
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
