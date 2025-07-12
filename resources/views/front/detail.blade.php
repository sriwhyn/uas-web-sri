@extends('layouts.front')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow border-0">
                <div class="card-body p-5">

                    {{-- Judul --}}
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-primary">{{ $event->judul }}</h2>
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
                            <strong>Oops!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Gambar Event --}}
                    @if($event->gambar)
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $event->gambar) }}" alt="{{ $event->judul }}" class="img-fluid rounded shadow-sm" style="max-height: 350px; object-fit: cover;">
                        </div>
                    @endif

                    {{-- Info Utama --}}
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3 text-center text-muted small mb-4">
                        <div>
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-tag text-primary fs-5 mb-1"></i>
                                <span>Kategori</span>
                                <strong class="text-dark">{{ $event->kategori->nama_kategori }}</strong>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-calendar text-primary fs-5 mb-1"></i>
                                <span>Tanggal</span>
                                <strong class="text-dark">{{ $event->tanggal->format('d M Y') }}</strong>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-geo-alt text-primary fs-5 mb-1"></i>
                                <span>Lokasi</span>
                                <strong class="text-dark">{{ $event->lokasi }}</strong>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-people text-primary fs-5 mb-1"></i>
                                <span>Kuota</span>
                                <strong class="text-dark">
                                    @if(!is_null($event->sisa_kuota))
                                        {{ $event->sisa_kuota }} dari {{ $event->kuota }}
                                    @else
                                        Tidak dibatasi
                                    @endif
                                </strong>
                            </div>
                        </div>
                    </div>

                    {{-- Penyelenggara --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-briefcase-fill text-primary me-2"></i>
                            <strong class="me-2">Penyelenggara:</strong>
                            <span>{{ $event->penyelenggara ?? 'Tidak diketahui' }}</span>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-5">
                        <h5 class="text-primary mb-2"><i class="bi bi-file-earmark-text me-2"></i> Deskripsi</h5>
                        <div class="bg-light p-4 rounded shadow-sm">
                            {!! nl2br(e($event->deskripsi)) !!}
                        </div>
                    </div>

                    {{-- Tombol Daftar --}}
                    <div class="text-center border-top pt-4">
                        @auth
                            <a href="{{ route('event.form.daftar', $event->id) }}" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-pencil-square me-2"></i> Daftar Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-4">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login untuk Mendaftar
                            </a>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
