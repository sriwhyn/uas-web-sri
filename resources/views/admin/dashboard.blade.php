@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row text-center mb-4">
        <h2 class="text-primary fw-bold">Selamat Datang, Admin!</h2>
        <p class="text-muted">Kelola data sistem seminar & event dengan mudah dari dashboard ini.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow border-0 bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-folder-fill fs-1 me-3"></i>
                        <div>
                            <h5 class="card-title mb-1">Kategori</h5>
                            <h3>{{ $totalKategori }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-0 bg-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-calendar-event-fill fs-1 me-3"></i>
                        <div>
                            <h5 class="card-title mb-1">Event</h5>
                            <h3>{{ $totalEvent }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-0 bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-megaphone-fill fs-1 me-3"></i>
                        <div>
                            <h5 class="card-title mb-1">Pengumuman</h5>
                            <h3>{{ $totalPengumuman }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-0 bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-check-fill fs-1 me-3"></i>
                        <div>
                            <h5 class="card-title mb-1">Pendaftaran</h5>
                            <h3>{{ $totalPendaftaran }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
