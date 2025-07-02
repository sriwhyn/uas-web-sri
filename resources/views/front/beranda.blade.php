@extends('layouts.front')

@section('content')

<!-- HERO SECTION -->
<header class="position-relative text-white" style="min-height: 85vh; background: linear-gradient(135deg, #d0ebff 0%, #e7f5ff 100%), url('https://images.unsplash.com/photo-1581092334034-79dfb6d4f9b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;">
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center py-5">
        
        <div class="bg-white rounded-circle shadow d-flex justify-content-center align-items-center mb-4 animate__animated animate__fadeInDown" style="width: 100px; height: 100px;">
            <i class="bi bi-calendar3-event text-primary" style="font-size: 3rem;"></i>
        </div>

        <h1 class="display-5 fw-bold text-dark animate__animated animate__fadeInUp">
            Temukan & Ikuti Event Terbaik di PNP
        </h1>

        <div class="d-inline-flex align-items-center gap-2 py-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-megaphone-fill"></i>
            </div>
            <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-mic-fill"></i>
            </div>
            <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-lightbulb-fill"></i>
            </div>
        </div>

        <!-- Deskripsi -->
        <p class="lead text-dark mb-4 animate__animated animate__fadeInUp animate__delay-1s">
            Webinar, seminar, dan kegiatan kampus seru menantimu setiap hari!
        </p>

        <!-- Tombol -->
        <a href="#event-list" class="btn btn-primary btn-lg rounded-pill px-4 shadow animate__animated animate__zoomIn animate__delay-2s">
            <i class="bi bi-search me-2"></i> Lihat Event
        </a>
    </div>
</header>



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
    <h2 class="text-center fw-bold mb-5 text-primary">📢 Pengumuman PNP Terbaru</h2>
    <div class="row g-4 mb-5">
        @forelse ($pengumumans as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow border-0 rounded-4 bg-light animate__animated animate__fadeInUp">
                    <div class="card-body position-relative">
                        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">
                            <i class="bi bi-megaphone"></i> Info
                        </span>
                        <h5 class="fw-bold text-primary mt-3">{{ $item->judul }}</h5>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-calendar"></i> {{ $item->created_at->format('d M Y') }}
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
                <div class="alert alert-info text-center">Belum ada pengumuman PNP saat ini.</div>
            </div>
        @endforelse
    </div>

    <!-- EVENT -->
    <h2 id="event-list" class="text-center fw-bold mb-5 text-primary">🎟️ Event Kampus PNP Terbaru</h2>
    <div class="row g-4">
        @forelse ($events as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 animate__animated animate__fadeInUp">
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
                <div class="alert alert-info text-center">Belum ada event kampus PNP saat ini.</div>
            </div>
        @endforelse
    </div>
</div>

<!-- FOOTER -->
<footer class="bg-light text-secondary py-4 mt-5 border-top">
    <div class="container text-center">
        &copy; 2025 Portal Kampus PNP. Sri Wahyuni
    </div>
</footer>

<!-- MODAL DETAIL PENGUMUMAN -->
<div class="modal fade" id="announcementDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title">Detail Pengumuman</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
                <button class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JS MODAL SCRIPT -->
<script>
document.addEventListener('show.bs.modal', function (e) {
    const btn = e.relatedTarget;
    if (!btn) return;
    document.getElementById('modalAnnouncementJudul').textContent = btn.dataset.judul;
    document.getElementById('modalAnnouncementIsi').textContent = btn.dataset.isi;
    document.getElementById('modalAnnouncementTanggal').textContent = btn.dataset.tanggal;
});
</script>

<!-- Bootstrap Animate (Optional CDN) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>

@endsection
