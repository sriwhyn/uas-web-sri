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
                <dd class="col-sm-8">{{ $pendaftaran->user->name }}</dd>

                <dt class="col-sm-4">Email Mahasiswa</dt>
                <dd class="col-sm-8">{{ $pendaftaran->user->email }}</dd>

                <dt class="col-sm-4">Judul Event</dt>
                <dd class="col-sm-8">{{ $pendaftaran->event->judul }}</dd>

                <dt class="col-sm-4">Tanggal Event</dt>
                <dd class="col-sm-8">{{ $pendaftaran->event->tanggal->format('d M Y') }}</dd>

                <dt class="col-sm-4">Lokasi Event</dt>
                <dd class="col-sm-8">{{ $pendaftaran->event->lokasi }}</dd>

                <dt class="col-sm-4">Status Pendaftaran</dt>
                <dd class="col-sm-8">
                    <span class="badge rounded-pill
                        @if($pendaftaran->status === 'disetujui') bg-success
                        @elseif($pendaftaran->status === 'ditolak') bg-danger
                        @else bg-secondary
                        @endif">
                        {{ $pendaftaran->status === 'disetujui' ? 'Terdaftar' : ucfirst($pendaftaran->status) }}
                    </span>
                </dd>

                <dt class="col-sm-4">Tanggal Daftar</dt>
                <dd class="col-sm-8">{{ $pendaftaran->tanggal_daftar ? $pendaftaran->tanggal_daftar->format('d M Y H:i') : 'N/A' }}</dd>
            </dl>
        </div>

        <div class="card-footer bg-light d-flex justify-content-between">
            {{-- Tombol Aksi Status --}}
            <div>
                @if($pendaftaran->status === 'menunggu')
                    <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="disetujui">
                        <button type="submit" class="btn btn-success btn-sm me-1">
                            <i class="bi bi-check-circle me-1"></i> Setujui
                        </button>
                    </form>
                    <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="ditolak">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-x-circle me-1"></i> Tolak
                        </button>
                    </form>
                @elseif($pendaftaran->status === 'disetujui')
                    <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="ditolak">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-x-circle me-1"></i> Tolak
                        </button>
                    </form>
                @elseif($pendaftaran->status === 'ditolak')
                    <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="disetujui">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="bi bi-check-circle me-1"></i> Setujui
                        </button>
                    </form>
                @endif
            </div>

            {{-- Tombol Kembali --}}
            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
