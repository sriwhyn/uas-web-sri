@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <h2 class="h4 mb-3 text-center fw-bold text-primary">
                        <i class="bi bi-megaphone-fill me-2"></i>Tambah Pengumuman
                    </h2>
                    <p class="text-muted text-center mb-4">Silakan isi informasi pengumuman di bawah ini.</p>

                    <form action="{{ route('admin.pengumuman.store') }}" method="POST" novalidate>
                        @csrf

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Pengumuman</label>
                            <input type="text" id="judul" name="judul"
                                class="form-control @error('judul') is-invalid @enderror"
                                placeholder="Masukkan judul pengumuman" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Isi --}}
                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi Pengumuman</label>
                            <textarea id="isi" name="isi" rows="5"
                                class="form-control @error('isi') is-invalid @enderror"
                                placeholder="Tulis isi pengumuman lengkap..." required>{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
