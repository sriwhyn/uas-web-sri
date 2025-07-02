@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">👋 Selamat Datang, Admin!</h2>
        <p class="text-muted">Kelola data kategori, event, pengumuman dan pendaftaran dengan mudah.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width:60px; height:60px;">
                        <i class="bi bi-tags fs-3"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="text-muted mb-1">Kategori</h6>
                        <h4 class="text-primary mb-0">{{ $totalKategori }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-info text-white rounded-circle d-flex justify-content-center align-items-center" style="width:60px; height:60px;">
                        <i class="bi bi-calendar-event-fill fs-3"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="text-muted mb-1">Event</h6>
                        <h4 class="text-info mb-0">{{ $totalEvent }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center" style="width:60px; height:60px;">
                        <i class="bi bi-megaphone-fill fs-3"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="text-muted mb-1">Pengumuman</h6>
                        <h4 class="text-success mb-0">{{ $totalPengumuman }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning text-dark rounded-circle d-flex justify-content-center align-items-center" style="width:60px; height:60px;">
                        <i class="bi bi-person-check-fill fs-3"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="text-muted mb-1">Pendaftaran</h6>
                        <h4 class="text-warning mb-0">{{ $totalPendaftaran }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
