@extends('layouts.front')

@section('content')
<div class="bg-info py-5 mb-5">
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold mb-3 text-dark">Temukan Webinar Menarik Bersama Kami!</h1>
        <p class="lead mb-4 text-dark">Dapatkan pengalaman belajar dan networking terbaik dari berbagai topik pilihan.</p>
        <a href="#event-list" class="btn btn-outline-primary btn-lg rounded-pill px-4 shadow">Lihat Event Terbaru <i class="bi bi-arrow-down-circle ms-2"></i></a>
    </div>
</div>

<div class="container mb-5">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 class="text-center mb-4 pb-2 border-bottom border-info text-info">Pengumuman Terbaru</h2>
    <div class="row g-4 mb-5">
        @if(isset($pengumumans) && $pengumumans->isNotEmpty())
            @foreach($pengumumans as $item)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 bg-light border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-info">{{ $item->judul }}</h5>
                            <span class="badge bg-warning text-dark mb-2"><i class="bi bi-calendar me-1"></i>{{ $item->created_at->format('d M Y') }}</span>
                            <p class="card-text text-secondary">{{ Str::limit($item->isi, 120) }}</p>
                            <button type="button" class="btn btn-link p-0 text-decoration-none text-info" data-bs-toggle="modal" data-bs-target="#announcementDetailModal" data-judul="{{ $item->judul }}" data-isi="{{ $item->isi }}" data-tanggal="{{ $item->created_at->format('d M Y') }}">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info text-center rounded-3 shadow-sm" role="alert">
                    Belum ada pengumuman saat ini.
                </div>
            </div>
        @endif
    </div>

    <h2 class="text-center mb-5 pb-2 border-bottom border-info text-info" id="event-list">Event Webinar Terbaru</h2>
    <div class="row g-4">
        @if(isset($events) && $events->isNotEmpty())
            @foreach($events as $item)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 bg-light border-0 shadow-sm">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 180px; object-fit: cover;">
                        @else
                            <div class="bg-white d-flex align-items-center justify-content-center text-muted" style="height: 180px;">
                                <i class="bi bi-image display-4"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-info">{{ $item->judul }}</h5>
                            <ul class="list-unstyled mb-2">
                                <li><span class="badge bg-info text-dark"><i class="bi bi-calendar me-1"></i> {{ $item->tanggal->format('d M Y') }}</span></li>
                                <li class="mt-1"><i class="bi bi-geo-alt me-1"></i> {{ $item->lokasi }}</li>
                                <li><i class="bi bi-tag me-1"></i> {{ $item->kategori->nama_kategori }}</li>
                            </ul>
                            <p class="card-text text-secondary flex-grow-1">{{ Str::limit($item->deskripsi, 80) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('event.detail', $item->id) }}" class="btn btn-outline-info rounded-pill btn-sm px-3 mt-2">Detail Event <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info text-center rounded-3 shadow-sm" role="alert">
                    Belum ada event webinar yang tersedia saat ini. Tetap pantau untuk update selanjutnya!
                </div>
            </div>
        @endif
    </div>
</div>

<footer class="bg-light text-secondary py-4 mt-5 border-top">
    <div class="container text-center">
        <p class="mb-0">&copy; 2024 Webinar Event Sri. All rights reserved.</p>
    </div>
</footer>

<!-- Modal Detail Pengumuman -->
<div class="modal fade" id="announcementDetailModal" tabindex="-1" aria-labelledby="announcementDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-3 shadow-lg">
            <div class="modal-header bg-info text-dark rounded-top-3">
                <h5 class="modal-title" id="announcementDetailModalLabel">Detail Pengumuman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <h4 id="modalAnnouncementJudul" class="text-info fw-bold mb-3"></h4>
                <p class="text-muted small mb-3"><i class="bi bi-calendar me-1"></i> <span id="modalAnnouncementTanggal"></span></p>
                <p id="modalAnnouncementIsi" class="text-secondary"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const announcementDetailModal = document.getElementById('announcementDetailModal');
        announcementDetailModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var judul = button.getAttribute('data-judul');
            var isi = button.getAttribute('data-isi');
            var tanggal = button.getAttribute('data-tanggal');
            var modalTitle = announcementDetailModal.querySelector('#modalAnnouncementJudul');
            var modalBody = announcementDetailModal.querySelector('#modalAnnouncementIsi');
            var modalTanggal = announcementDetailModal.querySelector('#modalAnnouncementTanggal');
            modalTitle.textContent = judul;
            modalBody.textContent = isi;
            modalTanggal.textContent = tanggal;
        });
    });
</script>
@endsection
