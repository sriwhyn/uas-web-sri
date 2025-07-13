@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-people-fill me-2"></i>Daftar Pendaftaran Event
            </h5>
        </div>

        <div class="card-body">
            {{-- Flash Messages --}}
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-x-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- Filter Form --}}
            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-6">
                    <select name="status_peserta" class="form-select">
                        <option value="">Semua Status Peserta</option>
                        <option value="mahasiswa" {{ request('status_peserta') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa Politeknik</option>
                        <option value="umum" {{ request('status_peserta') == 'umum' ? 'selected' : '' }}>Umum</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                </div>
            </form>

            @if ($pendaftaran->isEmpty())
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle me-2"></i>Belum ada data pendaftaran yang tersedia.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Nama Peserta</th>
                            <th>Status Peserta</th>
                            <th>Judul Event</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftaran as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td class="text-center text-capitalize">
                                <span class="badge bg-info">{{ $item->status_pendaftaran }}</span>
                            </td>
                            <td>{{ $item->event->judul }}</td>
                            <td class="text-center">
                                <span class="badge bg-success">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.pendaftaran.show', $item->id) }}" class="btn btn-sm btn-primary me-1" title="Detail">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger delete-button" data-id="{{ $item->id }}" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left-circle me-1"></i> Dashboard
        </a>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data pendaftaran ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script Modal --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const deleteButtons = document.querySelectorAll('.delete-button');
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const action = `{{ route('admin.pendaftaran.destroy', ':id') }}`.replace(':id', id);
                deleteForm.action = action;
                deleteModal.show();
            });
        });
    });
</script>
@endsection
