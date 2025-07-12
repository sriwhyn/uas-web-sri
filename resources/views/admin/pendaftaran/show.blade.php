@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">
                <i class="bi bi-person-lines-fill me-2"></i> Detail Pendaftaran
            </h4>
            <small class="text-white-50">Informasi lengkap mengenai pendaftaran</small>
        </div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Kode Pendaftaran</dt>
                <dd class="col-sm-8">
                    <span class="badge text-bg-primary">
                        {{ $pendaftaran->kode_pendaftaran ?? 'N/A' }}
                    </span>
                </dd>

                <dt class="col-sm-4">Nama Mahasiswa</dt>
                <dd class="col-sm-8">{{ $pendaftaran->nama ?? '-' }}</dd>

                <dt class="col-sm-4">NIM</dt>
                <dd class="col-sm-8">{{ $pendaftaran->nim ?? '-' }}</dd>

                <dt class="col-sm-4">Jurusan</dt>
                <dd class="col-sm-8">{{ $pendaftaran->jurusan ?? '-' }}</dd>

                <dt class="col-sm-4">Program Studi</dt>
                <dd class="col-sm-8">{{ $pendaftaran->prodi ?? '-' }}</dd>

                <dt class="col-sm-4">Judul Event</dt>
                <dd class="col-sm-8">{{ $pendaftaran->event->judul }}</dd>

                <dt class="col-sm-4">Tanggal Event</dt>
                <dd class="col-sm-8">{{ $pendaftaran->event->tanggal->format('d M Y') }}</dd>

                <dt class="col-sm-4">Lokasi Event</dt>
                <dd class="col-sm-8">{{ $pendaftaran->event->lokasi }}</dd>

                <dt class="col-sm-4">Status Pendaftaran</dt>
                <dd class="col-sm-8">
                    <span class="badge rounded-pill 
                        {{ $pendaftaran->status == 'disetujui' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($pendaftaran->status) }}
                    </span>
                </dd>

                <dt class="col-sm-4">Tanggal Daftar</dt>
                <dd class="col-sm-8">
                    {{ $pendaftaran->tanggal_daftar ? $pendaftaran->tanggal_daftar->format('d M Y H:i') : 'N/A' }}
                </dd>
            </dl>
        </div>

        <div class="card-footer bg-light text-end">
            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
