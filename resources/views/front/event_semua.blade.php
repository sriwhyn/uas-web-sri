@extends('layouts.front')

@section('content')
<div class="container py-5">
    <h2 class="text-primary mb-4 text-center">Semua Event</h2>

    <form method="GET" class="mb-4 text-center">
        <select name="kategori" class="form-select w-50 mx-auto" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach ($kategoriList as $kategori)
                <option value="{{ $kategori->id }}" {{ $kategori->id == $kategoriId ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </select>
    </form>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($events as $event)
        <div class="col">
            <div class="card h-100 shadow-sm">
                @if($event->gambar)
                    <img src="{{ asset('storage/' . $event->gambar) }}" class="card-img-top" alt="{{ $event->judul }}">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary">{{ $event->judul }}</h5>
                    <p class="card-text text-muted mb-2">
                        <i class="bi bi-calendar"></i> {{ $event->tanggal->format('d M Y') }}
                    </p>
                    <a href="{{ route('event.detail', $event->id) }}" class="btn btn-outline-primary mt-auto btn-sm rounded-pill">
                        Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Belum ada event tersedia.</p>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $events->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
