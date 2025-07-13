@extends('layouts.front')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 text-primary">🗂️ Event yang Anda Daftar</h3>

    @if ($eventSaya->count())
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach ($eventSaya as $daftar)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $daftar->event->judul }}</h5>
                        <p class="card-text mb-1"><strong>Tanggal Daftar:</strong> {{ \Carbon\Carbon::parse($daftar->tanggal_daftar)->translatedFormat('d F Y') }}</p>
                        <p class="card-text"><strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($daftar->status) }}</span></p>
                        <a href="{{ route('event.detail', $daftar->event->id) }}" class="btn btn-outline-primary btn-sm">Lihat Event</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Anda belum mendaftar ke event manapun.
        </div>
    @endif
</div>
@endsection
