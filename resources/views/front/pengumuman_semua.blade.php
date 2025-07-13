@extends('layouts.front')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary mb-4">📢 Semua Pengumuman</h2>

    {{-- Form Pencarian --}}
    <form method="GET" action="{{ route('pengumuman.semua') }}" class="mb-4">
        <div class="input-group w-75 mx-auto position-relative">
            <input type="text" name="search" id="search-input"
                value="{{ request('search') }}"
                class="form-control rounded-start"
                placeholder="🔍 Cari pengumuman berdasarkan judul...">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
        <ul id="suggestions" class="list-group w-75 mx-auto position-absolute z-3" style="top: 100%; display: none;"></ul>
    </form>

    {{-- Daftar Pengumuman --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($pengumumans as $pengumuman)
        <div class="col">
            <div class="card shadow-sm h-100 border-0" style="background-color: #f4faff;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary">
                        <a href="{{ route('pengumuman.detail', $pengumuman->id) }}" class="text-decoration-none">
                            {{ $pengumuman->judul }}
                        </a>
                    </h5>
                    <p class="card-text small text-muted">
                        <i class="bi bi-calendar me-1"></i>
                        {{ \Carbon\Carbon::parse($pengumuman->created_at)->translatedFormat('d F Y') }}
                    </p>
                    <p class="card-text text-secondary flex-grow-1">
                        {{ Str::limit(strip_tags($pengumuman->isi), 120, '...') }}
                    </p>
                    <a href="{{ route('pengumuman.detail', $pengumuman->id) }}" class="btn btn-sm rounded-pill mt-auto text-white" style="background-color: #4da3ff;">
                        <i class="bi bi-book me-1"></i> Lihat Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">Belum ada pengumuman.</div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $pengumumans->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('search-input');
        const suggestions = document.getElementById('suggestions');

        input.addEventListener('keyup', function () {
            const query = this.value;
            if (query.length < 1) {
                suggestions.style.display = 'none';
                return;
            }

            fetch(`/pengumuman/suggest?query=${query}`)
                .then(res => res.json())
                .then(data => {
                    suggestions.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.className = 'list-group-item list-group-item-action';
                            li.textContent = item.judul;
                            li.onclick = function () {
                                input.value = item.judul;
                                suggestions.style.display = 'none';
                            };
                            suggestions.appendChild(li);
                        });
                        suggestions.style.display = 'block';
                    } else {
                        suggestions.style.display = 'none';
                    }
                });
        });

        document.addEventListener('click', function (e) {
            if (!suggestions.contains(e.target) && e.target !== input) {
                suggestions.style.display = 'none';
            }
        });
    });
</script>
@endpush