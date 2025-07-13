@extends('layouts.front')

@section('content')
<div class="container mt-5">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow rounded-4">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Formulir Pendaftaran</h4>
                <small>{{ $event->judul }}</small>
            </div>

            <div class="card-body p-4">
                {{-- Flash Message --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('event.daftar') }}">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="status_pendaftaran" class="form-label">Status Peserta</label>
                        <select id="status_pendaftaran" name="status_pendaftaran" class="form-select" onchange="toggleFields()" required>
                            <option value="">-- Pilih --</option>
                            <option value="mahasiswa">Mahasiswa Politeknik</option>
                            <option value="umum">Umum</option>
                        </select>
                    </div>

                    {{-- Untuk Mahasiswa --}}
                    <div id="mahasiswaFields" style="display: none;">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" id="nim" name="nim" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" id="jurusan" name="jurusan" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <input type="text" id="prodi" name="prodi" class="form-control">
                        </div>
                    </div>

                    {{-- Untuk Umum --}}
                    <div class="mb-4" id="institusiField" style="display: none;">
                        <label for="institusi" class="form-label">Asal Institusi (Opsional)</label>
                        <input type="text" id="institusi" name="institusi" class="form-control">
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary px-4" type="submit">
                            <i class="bi bi-send me-1"></i>Daftar Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script Toggle --}}
<script>
    function toggleFields() {
        const status = document.getElementById('status_pendaftaran').value;
        const mahasiswaFields = document.getElementById('mahasiswaFields');
        const institusiField = document.getElementById('institusiField');

        if (status === 'mahasiswa') {
            mahasiswaFields.style.display = 'block';
            institusiField.style.display = 'none';
        } else if (status === 'umum') {
            mahasiswaFields.style.display = 'none';
            institusiField.style.display = 'block';
        } else {
            mahasiswaFields.style.display = 'none';
            institusiField.style.display = 'none';
        }
    }
</script>
@endsection
