@extends('layouts.front')

@section('content')

<!-- HERO SECTION -->
<header class="position-relative text-white" style="min-height: 85vh; background: linear-gradient(135deg, #d0ebff 0%, #e7f5ff 100%), url('https://images.unsplash.com/photo-1581092334034-79dfb6d4f9b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;">
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center py-5">
        <div class="bg-white rounded-circle shadow d-flex justify-content-center align-items-center mb-4 animate__animated animate__fadeInDown" style="width: 100px; height: 100px;">
            <i class="bi bi-info-circle-fill text-primary" style="font-size: 3rem;"></i>
        </div>

        <h1 class="display-4 fw-bold text-dark animate__animated animate__fadeInUp">Pusat Informasi Kampus PNP</h1>

        <div class="d-inline-flex align-items-center gap-2 py-3 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-megaphone-fill"></i>
            </div>
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-mic-fill"></i>
            </div>
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-lightbulb-fill"></i>
            </div>
        </div>

        <p class="lead text-dark mb-4 animate__animated animate__fadeInUp animate__delay-1s">
            Temukan pengumuman, webinar, dan kegiatan menarik lainnya di lingkungan kampus Politeknik Negeri Padang.
        </p>

        <a href="#event-list" class="btn btn-primary btn-lg rounded-pill px-4 shadow animate__animated animate__zoomIn animate__delay-2s">
            <i class="bi bi-search me-2"></i> Jelajahi Event
        </a>
    </div>
</header>

<!-- ISI KONTEN -->
<div class="container py-5">
    @foreach (['success'=>'check','error'=>'x'] as $type => $icon)
        @if (session($type))
            <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                <i class="bi bi-{{ $icon }}-circle-fill me-2"></i>{{ session($type) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    @endforeach

    <!-- PENGUMUMAN -->
    <h2 class="text-center fw-bold mb-5 text-primary">Pengumuman PNP Terbaru</h2>
    <div class="row g-4 mb-5">
        @forelse ($pengumumans as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 bg-light animate__animated animate__fadeInUp">
                    <div class="card-body position-relative">
                        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">
                            <i class="bi bi-megaphone"></i> Info
                        </span>
                        <h5 class="fw-bold text-primary mt-3">{{ $item->judul }}</h5>
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-calendar"></i> {{ $item->created_at->format('d M Y') }}
                        </small>
                        <p class="text-secondary mb-3">{{ Str::limit($item->isi, 100) }}</p>
                        <button class="btn btn-link p-0 text-primary" data-bs-toggle="modal" data-bs-target="#announcementDetailModal" data-judul="{{ $item->judul }}" data-isi="{{ $item->isi }}" data-tanggal="{{ $item->created_at->format('d M Y') }}">
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

    <!-- EVENT -->
    <h2 id="event-list" class="text-center fw-bold mb-5 text-primary">Event Kampus Terbaru</h2>
    <div class="row g-4">
        @forelse ($events as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 animate__animated animate__fadeInUp">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top rounded-top-4 img-fluid" alt="{{ $item->judul }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold text-primary">{{ $item->judul }}</h5>
                        <ul class="list-unstyled small text-muted mb-3">
                            <li><i class="bi bi-calendar me-1 text-info"></i>{{ $item->tanggal->format('d M Y') }}</li>
                            <li><i class="bi bi-geo-alt me-1 text-danger"></i>{{ $item->lokasi }}</li>
                            <li><i class="bi bi-tag me-1 text-success"></i>{{ $item->kategori->nama_kategori }}</li>
                            <li><i class="bi bi-person-circle me-1 text-primary"></i>{{ $item->penyelenggara ?? 'Tidak diketahui' }}</li>
                        </ul>
                        <p class="text-secondary flex-grow-1">{{ Str::limit($item->deskripsi, 80) }}</p>
                        <a href="{{ route('event.detail', $item->id) }}" class="btn btn-outline-primary rounded-pill btn-sm mt-auto">
                            Detail Event <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada event kampus saat ini.</div>
            </div>
        @endforelse
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('event.semua') }}" class="btn btn-outline-primary rounded-pill">Lihat Semua Event</a>
    </div>
</div>

<footer class="bg-light text-center border-top pt-5 pb-3 mt-5">
    <div class="container">
        <h4 class="fw-bold text-primary mb-4">PUSAT INFORMASI KAMPUS PNP</h4>
        <div class="row justify-content-center mb-4 text-muted small">
            <div class="col-md-2 col-6 mb-3">
                <a href="tel:0123456789" class="text-decoration-none text-dark">
                    <i class="bi bi-telephone-fill fs-4 d-block text-primary mb-1"></i>
                    <strong>Telepon</strong><br>
                    <span>081292389075</span>
                </a>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <a href="mailto:info.pnp@gmail.com" class="text-decoration-none text-dark">
                    <i class="bi bi-envelope-fill fs-4 d-block text-primary mb-1"></i>
                    <strong>Email</strong><br>
                    <span>whyn965@gmail.com</span>
                </a>
            </div>
            <div class="col-md-3 col-12 mb-3">
                <a href="https://maps.google.com/?q=Politeknik+Negeri+Padang" target="_blank" class="text-decoration-none text-dark">
                    <i class="bi bi-geo-alt-fill fs-4 d-block text-primary mb-1"></i>
                    <strong>Lokasi</strong><br>
                    <span>Politeknik Negeri Padang</span>
                </a>
            </div>
        </div>
        <div class="text-white bg-primary py-2 rounded-bottom">
            <small>
                © {{ date('Y') }} Pusat Informasi Kampus PNP. All Rights Reserved.
                <span class="text-white">Copyright by Sri Wahyuni</span>
            </small>
        </div>
    </div>
</footer>

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
                <button class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('show.bs.modal', function (e) {
    const btn = e.relatedTarget;
    if (!btn) return;
    document.getElementById('modalAnnouncementJudul').textContent = btn.dataset.judul;
    document.getElementById('modalAnnouncementIsi').textContent = btn.dataset.isi;
    document.getElementById('modalAnnouncementTanggal').textContent = btn.dataset.tanggal;
});
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>

@endsection
