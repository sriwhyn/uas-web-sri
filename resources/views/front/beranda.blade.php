@extends('layouts.front')

@section('content')

<!-- HERO SECTION -->
<header class="position-relative text-white overflow-hidden py-5 bg-primary bg-gradient">
    <div class="container text-center">
        <div class="bg-white rounded-circle shadow-lg d-flex justify-content-center align-items-center mx-auto mb-4 p-3" style="width: 140px; height: 140px;">
            <i class="bi bi-mortarboard-fill text-primary" style="font-size: 5rem;"></i>
        </div>
        <h1 class="display-4 fw-bold text-white">Pusat Informasi Kampus PNP</h1>
        <p class="lead text-white-50 mt-3 mx-auto" style="max-width: 720px;">
            Temukan pengumuman penting, jadwal webinar inspiratif, dan beragam kegiatan menarik lainnya dari lingkungan kampus Politeknik Negeri Padang.
        </p>
        <a href="#event-list" class="btn btn-light btn-lg rounded-pill px-4 py-2 shadow mt-4 fw-semibold text-primary">
            <i class="bi bi-calendar-event me-2"></i> Jelajahi Event Terbaru
        </a>
    </div>
</header>

<!-- PENGUMUMAN -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold text-primary mb-5"><i class="bi bi-megaphone-fill me-2"></i>Pengumuman PNP</h2>

        <div class="row g-4">
            @forelse ($pengumumans as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm bg-white">
                        <div class="card-body position-relative">
                            <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">
                                <i class="bi bi-megaphone"></i> Info
                            </span>
                            <h5 class="fw-bold text-primary mt-3">{{ $item->judul }}</h5>
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-calendar"></i> {{ $item->created_at->format('d M Y') }}
                            </small>
                            <p class="text-secondary mb-3">{{ Str::limit($item->isi, 100) }}</p>
                            <button class="btn btn-sm btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#announcementDetailModal" data-judul="{{ $item->judul }}" data-isi="{{ $item->isi }}" data-tanggal="{{ $item->created_at->format('d M Y') }}">
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

        <div class="text-center mt-4">
            <a href="{{ route('pengumuman.semua') }}" class="btn btn-outline-primary rounded-pill">
                <i class="bi bi-list-ul me-1"></i> Lihat Semua Pengumuman
            </a>
        </div>
    </div>
</section>

<!-- EVENT -->
<section class="py-5 bg-white">
    <div class="container">
        <h2 id="event-list" class="text-center fw-bold text-primary mb-5"><i class="bi bi-calendar-week me-2"></i>Event Kampus Terbaru</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse ($events as $item)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $item->judul }}">
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
                            <a href="{{ route('event.detail', $item->id) }}" class="btn btn-outline-primary btn-sm mt-auto w-100 rounded-pill">
                                <i class="bi bi-eye"></i> Detail Event
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
            <a href="{{ route('event.semua') }}" class="btn btn-outline-primary rounded-pill">
                <i class="bi bi-calendar4-week me-1"></i> Lihat Semua Event
            </a>
        </div>
    </div>
</section>

<!-- 
<footer class="bg-primary text-white text-center py-5 mt-5">
    <div class="container">
        <h4 class="fw-bold mb-4">Pusat Informasi Kampus PNP</h4>
        <div class="row justify-content-center">
            <div class="col-md-3 mb-3">
                <a href="tel:081292389075" class="text-white text-decoration-none d-block">
                    <i class="bi bi-telephone-fill fs-3 mb-2"></i>
                    <p class="mb-0">0812 9238 9075</p>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="mailto:whyn965@gmail.com" class="text-white text-decoration-none d-block">
                    <i class="bi bi-envelope-fill fs-3 mb-2"></i>
                    <p class="mb-0">whyn965@gmail.com</p>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="https://maps.google.com/?q=Politeknik+Negeri+Padang" target="_blank" class="text-white text-decoration-none d-block">
                    <i class="bi bi-geo-alt-fill fs-3 mb-2"></i>
                    <p class="mb-0">Politeknik Negeri Padang</p>
                </a>
            </div>
        </div>
        <hr class="bg-white">
        <p class="mb-0 small text-white-50">
            &copy; {{ date('Y') }} <strong>Pusat Informasi Kampus PNP</strong>. Dibuat oleh <strong>Sri Wahyuni</strong>
        </p>
    </div>
</footer> -->


<!-- MODAL -->
<div class="modal fade" id="announcementDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4">
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

<script>
    document.addEventListener('show.bs.modal', function(e) {
        const btn = e.relatedTarget;
        if (!btn) return;
        document.getElementById('modalAnnouncementJudul').textContent = btn.dataset.judul;
        document.getElementById('modalAnnouncementIsi').textContent = btn.dataset.isi;
        document.getElementById('modalAnnouncementTanggal').textContent = btn.dataset.tanggal;
    });
</script>

@endsection
