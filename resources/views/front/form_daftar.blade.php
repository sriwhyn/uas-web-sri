@extends('layouts.front')

@section('content')
<div class="container mt-5">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow">
            <div class="card-body p-5">
                <h4 class="mb-4 text-center text-primary">Formulir Pendaftaran: {{ $event->judul }}</h4>

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('event.daftar') }}">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <div class="mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Program Studi</label>
                        <input type="text" name="prodi" class="form-control" required>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary px-5" type="submit">Daftar Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
