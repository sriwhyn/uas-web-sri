@extends('layouts.front')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3 text-primary">{{ $pengumuman->judul }}</h2>
    <p class="text-muted">Diumumkan: {{ \Carbon\Carbon::parse($pengumuman->created_at)->format('d M Y') }}</p>
    <hr>
    <div>{!! $pengumuman->isi !!}</div>
    <a href="{{ route('pengumuman.semua') }}" class="btn btn-secondary mt-4">← Kembali ke semua pengumuman</a>
</div>
@endsection
