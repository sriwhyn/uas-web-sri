@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-calendar-event me-2"></i>Daftar Event
            </h4>
            <a href="{{ route('admin.event.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle me-1"></i>Tambah Event
            </a>
        </div>
        <div class="card-body">

            {{-- Flash Message --}}
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

            @if($events->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-1"></i>Belum ada event tersedia.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                            <tr>
                                <td class="text-center">
                                    @if($event->gambar)
                                        <img src="{{ asset('storage/' . $event->gambar) }}" alt="{{ $event->judul }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="text-muted"><i class="bi bi-image fs-4"></i></span>
                                    @endif
                                </td>
                                <td>{{ $event->judul }}</td>
                                <td>{{ $event->tanggal_pelaksanaan->format('d M Y') }}</td>
                                <td>{{ $event->lokasi }}</td>
                                <td>{{ $event->kategori->nama_kategori }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm delete-button" data-id="{{ $event->id }}">
                                        <i class="bi bi-trash"></i>
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
</div>

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel"><i class="bi bi-exclamation-triangle me-2"></i>Hapus Event</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus event ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="POST" id="deleteForm" class="d-inline">
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

{{-- Script Bootstrap Modal --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        const deleteForm = document.getElementById('deleteForm');
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                deleteForm.action = `{{ url('admin/event') }}/${id}`;
                deleteModal.show();
            });
        });
    });
</script>
@endsection
