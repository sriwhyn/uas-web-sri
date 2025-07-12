@extends('layouts.front')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-body p-5">

                    <div class="text-center mb-5">
                        <h2 class="display-5 fw-bold text-primary">{{ $event->judul }}</h2>
                        <p class="text-muted">Detail Informasi Event Kampus</p>
                    </div>

                    {{-- Alert --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Gambar Event --}}
                    @if($event->gambar)
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $event->gambar) }}" alt="{{ $event->judul }}" class="img-fluid rounded shadow-sm" style="max-height: 350px; object-fit: cover;">
                        </div>
                    @endif

                    {{-- Info Event --}}
                    <div class="row text-center mb-4">
                        <div class="col-md-3 mb-3">
                            <p class="mb-1 text-muted"><i class="bi bi-tag me-1 text-primary"></i> Kategori</p>
                            <h6>{{ $event->kategori->nama_kategori }}</h6>
                        </div>
                        <div class="col-md-3 mb-3">
                            <p class="mb-1 text-muted"><i class="bi bi-calendar me-1 text-primary"></i> Tanggal</p>
                            <h6>{{ $event->tanggal->format('d M Y') }}</h6>
                        </div>
                        <div class="col-md-3 mb-3">
                            <p class="mb-1 text-muted"><i class="bi bi-geo-alt me-1 text-primary"></i> Lokasi</p>
                            <h6>{{ $event->lokasi }}</h6>
                        </div>
                        <div class="col-md-3 mb-3">
                            <p class="mb-1 text-muted"><i class="bi bi-people-fill me-1 text-primary"></i> Kuota</p>
                            <h6>
                                @if(!is_null($event->sisa_kuota))
                                    {{ $event->sisa_kuota }} dari {{ $event->kuota }} tersisa
                                @else
                                    Tidak dibatasi
                                @endif
                            </h6>
                        </div>
                    </div>

                    <div class="mb-3">
                        <p class="mb-1 text-muted"><i class="bi bi-briefcase-fill me-1 text-primary"></i> Penyelenggara</p>
                        <h6>{{ $event->penyelenggara ?? 'Tidak diketahui' }}</h6>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-5">
                        <h5 class="text-primary"><i class="bi bi-file-earmark-text me-1"></i>Deskripsi:</h5>
                        <div class="bg-light p-4 rounded">
                            {!! nl2br(e($event->deskripsi)) !!}
                        </div>
                    </div>

                    {{-- Tombol Daftar --}}
                    <div class="pt-4 border-top">
                        @auth
                        <div class="text-center">
                            <a href="{{ route('event.form.daftar', $event->id) }}" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-pencil-square me-2"></i> Daftar Sekarang
                            </a>
                        </div>
                        @else
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-4">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login untuk Mendaftar
                            </a>
                        </div>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
