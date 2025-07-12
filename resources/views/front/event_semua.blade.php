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

    <div class="row">
        @forelse ($events as $event)
            {{-- Tampilkan event card --}}
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($event->gambar)
                        <img src="{{ asset('storage/' . $event->gambar) }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->judul }}</h5>
                        <p class="card-text text-muted">{{ $event->tanggal->format('d M Y') }}</p>
                        <a href="{{ route('event.detail', $event->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada event tersedia.</p>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $events->withQueryString()->links() }}
    </div>
</div>
@endsection
