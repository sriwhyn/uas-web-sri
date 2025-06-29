    @extends('layouts.admin')

    @section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="h4 mb-0">
                        <i class="bi bi-megaphone me-2"></i>Daftar Pengumuman
                    </h2>
                    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Pengumuman
                    </a>
                </div>
                <div class="card-body">
                {{-- Flash Messages --}}
                @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle-fill me-2"></i>
                            <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                    @if($pengumuman->isEmpty())
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada pengumuman yang tersedia. Silakan tambahkan pengumuman baru.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                        <th>Judul</th>
                                        <th>Isi</th>
                                        <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengumuman as $item)
                                        <tr>
                                            <td class="fw-medium">{{ $item->judul }}</td>
                                            <td>{{ Str::limit($item->isi, 100) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.pengumuman.edit', $item->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                                    <i class="bi bi-pencil"></i> Edit
                                            </a>
                                                <button type="button" data-id="{{ $item->id }}" class="delete-button btn btn-danger btn-sm" title="Hapus">
                                                    <i class="bi bi-trash"></i> Hapus
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
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <p class="mb-0">
                        Apakah Anda yakin ingin menghapus pengumuman ini? Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('deleteForm');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const pengumumanId = this.dataset.id;
                deleteForm.action = `{{ route('admin.pengumuman.destroy', 0) }}`.replace('0', pengumumanId);
                deleteModal.show();
                });
            });
        });
    </script>
@endsection 