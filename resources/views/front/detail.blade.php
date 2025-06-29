@extends('layouts.front')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="h2 fw-bold text-primary">{{ $event->judul }}</h2>
                        <p class="text-muted">Detail Event</p>
                    </div>

                    {{-- Flash Messages --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle-fill me-2"></i>
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($event->gambar)
                        <img src="{{ asset('storage/' . $event->gambar) }}" alt="{{ $event->judul }}" class="img-fluid rounded shadow-sm mb-4" style="max-height: 300px; width: 100%; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center text-muted rounded shadow-sm mb-4" style="height: 300px;">
                            <div class="text-center">
                                <i class="bi bi-image display-4"></i>
                                <p class="mt-2">Tidak Ada Gambar Tersedia</p>
                            </div>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong class="text-primary"><i class="bi bi-tag me-1"></i>Kategori:</strong><br>
                                {{ $event->kategori->nama_kategori }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong class="text-primary"><i class="bi bi-calendar me-1"></i>Tanggal:</strong><br>
                                {{ $event->tanggal->format('d M Y') }}
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="mb-2">
                                <strong class="text-primary"><i class="bi bi-geo-alt me-1"></i>Tempat:</strong><br>
                                {{ $event->lokasi }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-primary"><i class="bi bi-file-text me-1"></i>Deskripsi:</h5>
                        <div class="bg-light p-3 rounded">
                            {!! nl2br(e($event->deskripsi)) !!}
                        </div>
                    </div>

                    <div class="text-center pt-3 border-top">
                        @auth
                        <form action="{{ route('event.daftar') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                <i class="bi bi-person-plus me-2"></i>Daftar Event Ini
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-4">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login untuk Mendaftar
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
