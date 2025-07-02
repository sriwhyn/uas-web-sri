@extends('layouts.front')

@section('content')

<!-- Hero Section with blur and gradient -->
<div class="py-5 text-white position-relative" style="background: linear-gradient(120deg, rgba(179,216,255,0.9), rgba(224,242,255,0.9)), url('/img/header-bg.jpg') center/cover no-repeat;">
     <div class="container text-center py-5">
        <h5 class="mb-2 fw-semibold">Selamat Datang di Portal Kampus PNP</h5>
        <h1 class="display-4 fw-bold text-primary mb-3">
            Temukan & Ikuti Event Terbaik di PNP
        </h1>
        <p class="lead mb-4">
            Jelajahi webinar dan kegiatan kampus terbaru untuk pengembangan dirimu.
        </p>
        <a href="#event-list"
           class="btn btn-primary btn-lg rounded-pill px-4">
            Lihat Event <i class="bi bi-arrow-down-circle ms-2"></i>
        </a>
    </div>
</div>

<div class="container py-5">

    {{-- Flash Message --}}
    @foreach (['success'=>'check','error'=>'x'] as $type => $icon)
        @if (session($type))
            <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                <i class="bi bi-{{ $icon }}-circle-fill me-2"></i>{{ session($type) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    @endforeach

    <!-- PENGUMUMAN -->
    <h2 class="text-center fw-bold mb-5 text-primary">
        📢 Pengumuman PNP Terbaru
    </h2>
    <div class="row g-4 mb-5">
        @forelse ($pengumumans as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-body position-relative">
                        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 rounded-pill">
                            <i class="bi bi-megaphone"></i> Info
                        </span>
                        <h5 class="fw-bold text-primary mt-3">{{ $item->judul }}</h5>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-calendar"></i>
                            {{ $item->created_at->format('d M Y') }}
                        </small>
                        <p class="text-secondary mb-3">
                            {{ Str::limit($item->isi, 100) }}
                        </p>
                        <button class="btn btn-link p-0 text-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#announcementDetailModal"
                                data-judul="{{ $item->judul }}"
                                data-isi="{{ $item->isi }}"
                                data-tanggal="{{ $item->created_at->format('d M Y') }}">
                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada pengumuman PNP saat ini.
                </div>
            </div>
        @endforelse
    </div>

    <!-- EVENT -->
    <h2 id="event-list" class="text-center fw-bold mb-5 text-primary">
        🎟️ Event Kampus PNP Terbaru
    </h2>
    <div class="row g-4">
        @forelse ($events as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                             class="card-img-top rounded-top-4 img-fluid"
                             alt="{{ $item->judul }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold text-primary">{{ $item->judul }}</h5>
                        <ul class="list-unstyled small text-muted mb-3">
                            <li><i class="bi bi-calendar me-1 text-info"></i>{{ $item->tanggal->format('d M Y') }}</li>
                            <li><i class="bi bi-geo-alt me-1 text-danger"></i>{{ $item->lokasi }}</li>
                            <li><i class="bi bi-tag me-1 text-success"></i>{{ $item->kategori->nama_kategori }}</li>
                        </ul>
                        <p class="text-secondary flex-grow-1">
                            {{ Str::limit($item->deskripsi, 80) }}
                        </p>
                        <a href="{{ route('event.detail', $item->id) }}"
                           class="btn btn-outline-primary rounded-pill btn-sm mt-auto">
                            Detail Event <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada event kampus PNP saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- FOOTER -->
<footer class="bg-light text-secondary py-4 mt-5 border-top">
    <div class="container text-center">
        &copy; 2025 Portal Kampus PNP. Sri Wahyuni
    </div>
</footer>

<!-- MODAL DETAIL PENGUMUMAN -->
<div class="modal fade" id="announcementDetailModal"
     tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title">Detail Pengumuman</h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h4 id="modalAnnouncementJudul" class="text-primary fw-bold mb-3"></h4>
                <p class="text-muted small mb-3">
                    <i class="bi bi-calendar me-1"></i>
                    <span id="modalAnnouncementTanggal"></span>
                </p>
                <p id="modalAnnouncementIsi" class="text-secondary"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary rounded-pill"
                        data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

{{-- JS untuk isi konten modal --}}
<script>
document.addEventListener('show.bs.modal', function (e) {
    const btn = e.relatedTarget;
    if (!btn) return;
    document.getElementById('modalAnnouncementJudul').textContent = btn.dataset.judul;
    document.getElementById('modalAnnouncementIsi').textContent   = btn.dataset.isi;
    document.getElementById('modalAnnouncementTanggal').textContent = btn.dataset.tanggal;
});
</script>

@endsection
