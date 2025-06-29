@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Edit Event
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Judul -->
                            <div class="col-md-6">
                                <label for="judul" class="form-label">Judul Event</label>
                                <input id="judul" name="judul" type="text" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $event->judul) }}" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="col-md-6">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select id="kategori_id" name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id }}" {{ old('kategori_id', $event->kategori_id) == $kat->id ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal -->
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label">Tanggal Event</label>
                                <input id="tanggal" name="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    value="{{ old('tanggal', optional($event->tanggal)->format('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Lokasi -->
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label">Lokasi Event</label>
                                <input id="lokasi" name="lokasi" type="text" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $event->lokasi) }}" required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gambar -->
                            <div class="col-12">
                                <label for="gambar" class="form-label">Gambar Event (Biarkan kosong jika tidak ingin mengubah)</label>
                                <input id="gambar" name="gambar" type="file" accept="image/*" class="form-control @error('gambar') is-invalid @enderror">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if($event->gambar)
                                    <div class="mt-2">
                                        <p class="small text-muted mb-1">Gambar saat ini:</p>
                                        <img src="{{ asset('storage/' . $event->gambar) }}" alt="Gambar Event" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                @endif
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-12">
                                <label for="deskripsi" class="form-label">Deskripsi Event</label>
                                <textarea id="deskripsi" name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ route('admin.event.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Perbarui Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
