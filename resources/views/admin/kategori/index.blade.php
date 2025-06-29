<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manajemen Kategori</h2>
            <!-- Tombol untuk membuka modal tambah kategori -->
            <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
                Tambah Kategori Baru
            </button>
        </div>

        <!-- Pesan Flash (Success/Error) -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                <i class="bi bi-x-circle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tabel Kategori -->
        @if($kategoris->isEmpty())
            <div class="alert alert-info text-center rounded-3 shadow-sm" role="alert">
                Belum ada kategori yang tersedia.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover rounded-3 overflow-hidden" id="kategoriTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoris as $kategori)
                            <tr id="kategori-row-{{ $kategori->id }}">
                                <td>{{ $kategori->id }}</td>
                                <td>{{ $kategori->nama_kategori }}</td>
                                <td>{{ $kategori->created_at->format('d M Y H:i') }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Kategori"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="d-inline delete-kategori-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" title="Hapus Kategori"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="mt-3 text-center">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary rounded-pill px-4"><i class="bi bi-arrow-left-circle me-2"></i>Kembali ke Dashboard</a>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header bg-primary text-white rounded-top-3">
                    <h5 class="modal-title" id="addKategoriModalLabel">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="addKategoriForm" action="{{ route('admin.kategori.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_kategori_modal" class="form-label">Nama Kategori</label>
                            <input id="nama_kategori_modal" name="nama_kategori" type="text" autocomplete="off" required
                                class="form-control rounded-pill"
                                placeholder="Masukkan nama kategori" value="">
                            <div id="nama_kategori_modal_error" class="invalid-feedback d-block"></div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sertakan Bootstrap JS dari CDN (PENTING!) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addKategoriForm = document.getElementById('addKategoriForm');
            const namaKategoriModalInput = document.getElementById('nama_kategori_modal');
            const namaKategoriModalError = document.getElementById('nama_kategori_modal_error');
            const addKategoriModal = new bootstrap.Modal(document.getElementById('addKategoriModal'));
            const kategoriTableBody = document.querySelector('#kategoriTable tbody');
            const noKategoriAlert = document.querySelector('.alert-info'); // Alert "Belum ada kategori"

            // Fungsi untuk menampilkan pesan flash
            function showFlashMessage(message, type) {
                const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                        <i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'x-circle-fill'} me-2"></i> ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                document.querySelector('.container').insertAdjacentHTML('afterbegin', alertHtml);
            }

            // Reset form dan error saat modal ditutup atau dibuka
            addKategoriModal._element.addEventListener('hidden.bs.modal', function () {
                addKategoriForm.reset();
                namaKategoriModalInput.classList.remove('is-invalid');
                namaKategoriModalError.textContent = '';
            });

            addKategoriForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Mencegah submit form default

                const formData = new FormData(this);
                const url = this.action;
                const csrfToken = formData.get('_token');

                // Hapus error sebelumnya
                namaKategoriModalInput.classList.remove('is-invalid');
                namaKategoriModalError.textContent = '';

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken, // Kirim CSRF token di header
                        'X-Requested-With': 'XMLHttpRequest', // Tandai sebagai AJAX request
                        'Accept': 'application/json' // Minta respons JSON
                    },
                    body: formData
                })
                .then(response => response.json().then(data => ({ status: response.status, body: data })))
                .then(({ status, body }) => {
                    if (status === 200) { // Sukses
                        addKategoriModal.hide(); // Sembunyikan modal
                        showFlashMessage(body.success, 'success'); // Tampilkan pesan sukses

                        // Tambahkan baris baru ke tabel
                        const newRow = `
                            <tr id="kategori-row-${body.kategori.id}">
                                <td>${body.kategori.id}</td>
                                <td>${body.kategori.nama_kategori}</td>
                                <td>${new Date(body.kategori.created_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' })}</td>
                                <td class="text-nowrap">
                                    <a href="/admin/kategori/${body.kategori.id}/edit" class="btn btn-warning btn-sm me-1" title="Edit Kategori"><i class="bi bi-pencil"></i></a>
                                    <form action="/admin/kategori/${body.kategori.id}" method="POST" class="d-inline delete-kategori-form">
                                        <input type="hidden" name="_token" value="${csrfToken}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" title="Hapus Kategori"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        `;
                        kategoriTableBody.insertAdjacentHTML('beforeend', newRow);

                        // Sembunyikan alert "Belum ada kategori" jika ada
                        if (noKategoriAlert) {
                            noKategoriAlert.style.display = 'none';
                        }
                    } else if (status === 422) { // Validasi gagal
                        if (body.errors && body.errors.nama_kategori) {
                            namaKategoriModalInput.classList.add('is-invalid');
                            namaKategoriModalError.textContent = body.errors.nama_kategori[0];
                        }
                    } else { // Error lain
                        showFlashMessage('Terjadi kesalahan. Silakan coba lagi.', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showFlashMessage('Terjadi kesalahan jaringan atau server. Silakan coba lagi.', 'danger');
                });
            });

            // Handle delete form submission (AJAX)
            document.querySelectorAll('.delete-kategori-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (!confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                        return;
                    }

                    const url = this.action;
                    const method = this.querySelector('input[name="_method"]').value;
                    const csrfToken = this.querySelector('input[name="_token"]').value;
                    const rowId = this.closest('tr').id;

                    fetch(url, {
                        method: 'POST', // Fetch API menggunakan POST untuk _method DELETE
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'Content-Type': 'application/x-www-form-urlencoded' // Penting untuk DELETE dengan _method
                        },
                        body: `_method=${method}&_token=${csrfToken}`
                    })
                    .then(response => response.json().then(data => ({ status: response.status, body: data })))
                    .then(({ status, body }) => {
                        if (status === 200) {
                            showFlashMessage(body.success, 'success');
                            document.getElementById(rowId).remove(); // Hapus baris dari tabel

                            // Cek apakah tabel kosong setelah penghapusan
                            if (kategoriTableBody.children.length === 0) {
                                if (noKategoriAlert) {
                                    noKategoriAlert.style.display = 'block';
                                } else {
                                    // Jika alert belum ada, buat dan tambahkan
                                    const newAlertHtml = `
                                        <div class="alert alert-info text-center rounded-3 shadow-sm" role="alert">
                                            Belum ada kategori yang tersedia.
                                        </div>
                                    `;
                                    document.querySelector('.container').insertAdjacentHTML('beforeend', newAlertHtml);
                                }
                            }
                        } else {
                            showFlashMessage(body.error || 'Terjadi kesalahan saat menghapus kategori.', 'danger');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showFlashMessage('Terjadi kesalahan jaringan atau server saat menghapus.', 'danger');
                    });
                });
            });
        });
    </script>
</body>
</html>
