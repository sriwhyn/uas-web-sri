@extends('layouts.front')

@section('content')

<!-- Hero Section with blur and gradient -->
<div class="py-5 text-white position-relative" style="background: linear-gradient(120deg, rgba(179,216,255,0.9), rgba(224,242,255,0.9)), url('/img/header-bg.jpg') center/cover no-repeat;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="backdrop-filter: blur(5px);"></div>
    <div class="container text-center py-5 position-relative">
        <h5 class="text-dark mb-2 fw-semibold">Temukan Pengalaman Menarik</h5>
        <h1 class="display-4 fw-bold text-primary mb-3">Promosikan & Ikuti Webinar Terbaik</h1>
        <p class="lead text-dark mb-4">Akses webinar pilihan dari berbagai topik bermanfaat untuk pengembangan dirimu.</p>
        <a href="#event-list" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">Lihat Event <i class="bi bi-arrow-down-circle ms-2"></i></a>
    </div>
</div>

<div class="container py-5">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Pengumuman -->
    <h2 class="text-center fw-bold mb-5 text-primary">📢 Pengumuman Terbaru</h2>
    <div class="row g-4 mb-5">
        @forelse ($pengumumans as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow bg-white rounded-4 hover-shadow position-relative">
                    <div class="card-body">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 badge bg-warning text-dark rounded-pill px-3">
                            <i class="bi bi-megaphone"></i> Info
                        </div>
                        <h5 class="fw-bold text-primary mt-3">{{ $item->judul }}</h5>
                        <small class="text-muted d-block mb-2"><i class="bi bi-calendar"></i> {{ $item->created_at->format('d M Y') }}</small>
                        <p class="text-secondary mb-3">{{ Str::limit($item->isi, 100) }}</p>
                        <button class="btn btn-link text-primary p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#announcementDetailModal" data-judul="{{ $item->judul }}" data-isi="{{ $item->isi }}" data-tanggal="{{ $item->created_at->format('d M Y') }}">
                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada pengumuman saat ini.</div>
            </div>
        @endforelse
    </div>

    <!-- Event -->
    <h2 id="event-list" class="text-center fw-bold mb-5 text-primary">🎟️ Webinar Terbaru</h2>
    <div class="row g-4">
        @forelse ($events as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm bg-white rounded-4 hover-shadow position-relative">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top rounded-top-4" alt="{{ $item->judul }}" style="height: 180px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex justify-content-center align-items-center rounded-top-4" style="height: 180px;">
                            <i class="bi bi-image display-4 text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-primary">{{ $item->judul }}</h5>
                        <ul class="list-unstyled small text-muted mb-3">
                            <li><i class="bi bi-calendar me-1 text-info"></i>{{ $item->tanggal->format('d M Y') }}</li>
                            <li><i class="bi bi-geo-alt me-1 text-danger"></i>{{ $item->lokasi }}</li>
                            <li><i class="bi bi-tag me-1 text-success"></i>{{ $item->kategori->nama_kategori }}</li>
                        </ul>
                        <p class="text-secondary flex-grow-1">{{ Str::limit($item->deskripsi, 80) }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('event.detail', $item->id) }}" class="btn btn-outline-primary rounded-pill btn-sm">Detail Event <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada event webinar saat ini.</div>
            </div>
        @endforelse
    </div>
</div>

<!-- Footer -->
<footer class="bg-light text-secondary py-4 mt-5 border-top">
    <div class="container text-center">
        <p class="mb-0">&copy; 2025 Webinar Event Sri. All rights reserved.</p>
    </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="announcementDetailModal" tabindex="-1" aria-labelledby="announcementDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title">Detail Pengumuman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h4 id="modalAnnouncementJudul" class="text-primary fw-bold mb-3"></h4>
                <p class="text-muted small mb-3"><i class="bi bi-calendar me-1"></i><span id="modalAnnouncementTanggal"></span></p>
                <p id="modalAnnouncementIsi" class="text-secondary"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- JS Modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('announcementDetailModal');
    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('modalAnnouncementJudul').textContent = button.getAttribute('data-judul');
        document.getElementById('modalAnnouncementIsi').textContent = button.getAttribute('data-isi');
        document.getElementById('modalAnnouncementTanggal').textContent = button.getAttribute('data-tanggal');
    });
});
</script>

<!-- Extra Style -->
<style>
.hover-shadow:hover {
    transform: translateY(-6px);
    transition: 0.3s ease-in-out;
    box-shadow: 0 12px 24px rgba(0,0,0,0.1);
}
</style>

@endsection
