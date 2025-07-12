@extends('layouts.admin')

@section('content')
<div class="container py-4">

    {{-- ---------- Judul & Tombol Tambah ---------- --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0"><i class="bi bi-tag-fill me-2"></i>Manajemen Kategori</h4>
        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kategori Baru
        </button>
    </div>

    {{-- ---------- Flash Message ---------- --}}
    @foreach (['success'=>'check-circle', 'error'=>'x-circle'] as $type=>$icon)
        @if(session($type))
            <div class="alert alert-{{ $type=='success'?'success':'danger' }} alert-dismissible fade show shadow-sm">
                <i class="bi bi-{{ $icon }}-fill me-2"></i>{{ session($type) }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    @endforeach

    {{-- ---------- Tabel Kategori ---------- --}}
    @if($kategoris->isEmpty())
        <div class="alert alert-info text-center shadow-sm">Belum ada kategori yang tersedia.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle" id="kategoriTable">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Dibuat Pada</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoris as $kategori)
                        <tr id="kategori-row-{{ $kategori->id }}">
                            <td>{{ $kategori->id }}</td>
                            <td>{{ $kategori->nama_kategori }}</td>
                            <td>{{ $kategori->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $kategori->id) }}"
                                      method="POST" class="d-inline delete-kategori-form">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- ---------- Tombol Kembali ---------- --}}
    <div class="text-center mt-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left-circle me-1"></i> Dashboard
        </a>
    </div>
</div>

{{-- ---------- Modal Tambah Kategori ---------- --}}
<div class="modal fade" id="addKategoriModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow rounded-4">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah Kategori</h5>
            <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form id="addKategoriForm" action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori_modal"
                           class="form-control" required placeholder="Masukkan nama kategori">
                    <div class="invalid-feedback" id="nama_kategori_modal_error"></div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

{{-- ---------- Script Bootstrap & AJAX ---------- --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {

    const modal   = new bootstrap.Modal('#addKategoriModal');
    const formAdd = document.getElementById('addKategoriForm');
    const input   = document.getElementById('nama_kategori_modal');
    const errorEl = document.getElementById('nama_kategori_modal_error');
    const tableBody = document.querySelector('#kategoriTable tbody');
    const emptyAlert = document.querySelector('.alert-info');

    // reset form tiap modal ditutup
    document.getElementById('addKategoriModal')
        .addEventListener('hidden.bs.modal', () => {
            formAdd.reset();
            input.classList.remove('is-invalid');
            errorEl.textContent = '';
        });

    // tambah kategori via AJAX
    formAdd.addEventListener('submit', e => {
        e.preventDefault();
        const data = new FormData(formAdd);

        fetch(formAdd.action, {
            method:'POST',
            headers:{'X-Requested-With':'XMLHttpRequest'},
            body:data
        })
        .then(r=>r.json().then(d=>({status:r.status, body:d})))
        .then(({status, body})=>{
            if(status===200){
                modal.hide();
                flash(body.success,'success');
                prependRow(body.kategori);
            }else if(status===422){
                input.classList.add('is-invalid');
                errorEl.textContent = body.errors.nama_kategori[0];
            }else{
                flash('Terjadi kesalahan.','danger');
            }
        })
        .catch(()=>flash('Gagal terhubung ke server.','danger'));
    });

    // hapus kategori via AJAX
    document.querySelectorAll('.delete-kategori-form').forEach(f=>{
        f.addEventListener('submit',e=>{
            e.preventDefault();
            if(!confirm('Yakin hapus kategori ini?')) return;

            const url = f.action;
            const data = new URLSearchParams(new FormData(f));

            fetch(url,{
                method:'POST',
                headers:{'X-Requested-With':'XMLHttpRequest','Content-Type':'application/x-www-form-urlencoded'},
                body:data
            })
            .then(r=>r.json().then(d=>({status:r.status, body:d})))
            .then(({status, body})=>{
                if(status===200){
                    flash(body.success,'success');
                    f.closest('tr').remove();
                    if(!tableBody.children.length){
                        emptyAlert?.classList.remove('d-none');
                    }
                }else{
                    flash('Gagal menghapus kategori.','danger');
                }
            })
            .catch(()=>flash('Kesalahan jaringan.','danger'));
        });
    });

    // util – flash message
    function flash(msg,type){
        const html=`<div class="alert alert-${type} alert-dismissible fade show shadow-sm">
            <i class="bi bi-${type==='success'?'check-circle-fill':'x-circle-fill'} me-2"></i>${msg}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;
        document.querySelector('.container').insertAdjacentHTML('afterbegin',html);
    }

    // util – prepend baris baru
    function prependRow(kat){
        const html=`<tr id="kategori-row-${kat.id}">
            <td>${kat.id}</td>
            <td>${kat.nama_kategori}</td>
            <td>${new Date(kat.created_at).toLocaleString('id-ID',{day:'2-digit',month:'short',year:'numeric',hour:'2-digit',minute:'2-digit'})}</td>
            <td class="text-center">
                <a href="/admin/kategori/${kat.id}/edit" class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil"></i></a>
                <form action="/admin/kategori/${kat.id}" method="POST" class="d-inline delete-kategori-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>`;
        tableBody.insertAdjacentHTML('afterbegin',html);
        emptyAlert?.classList.add('d-none');
    }
});
</script>
@endpush
@endsection
