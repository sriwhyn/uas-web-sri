@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-inter">
    <div class="max-w-3xl w-full bg-white p-8 rounded-xl shadow-lg space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                Detail Pendaftaran
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Informasi lengkap mengenai pendaftaran ini.
            </p>
        </div>

        <div class="border-t border-gray-200 pt-4">
            <dl class="divide-y divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Kode Pendaftaran
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $pendaftaran->kode_pendaftaran ?? 'N/A' }}
                        </span>
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Nama Mahasiswa
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pendaftaran->user->name }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Email Mahasiswa
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pendaftaran->user->email }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Nama Event
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pendaftaran->event->judul }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Tanggal Event
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pendaftaran->event->tanggal->format('d M Y') }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Lokasi Event
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pendaftaran->event->lokasi }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Status Pendaftaran
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($pendaftaran->status === 'disetujui') bg-green-100 text-green-800
                            @elseif($pendaftaran->status === 'ditolak') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 {{-- Default styling for 'menunggu' or other statuses --}}
                            @endif">
                            {{ $pendaftaran->status === 'disetujui' ? 'Terdaftar' : ucfirst($pendaftaran->status) }}
                        </span>
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">
                        Tanggal Daftar
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pendaftaran->tanggal_daftar ? $pendaftaran->tanggal_daftar->format('d M Y H:i') : 'N/A' }}
                    </dd>
                </div>
            </dl>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            {{-- Tombol untuk mengubah status pendaftaran --}}
            @if($pendaftaran->status === 'menunggu')
                <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="disetujui">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Setujui Pendaftaran
                    </button>
                </form>
                <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="ditolak">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Tolak Pendaftaran
                    </button>
                </form>
            @elseif($pendaftaran->status === 'disetujui')
                <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="ditolak">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Tolak Pendaftaran
                    </button>
                </form>
            @elseif($pendaftaran->status === 'ditolak')
                <form action="{{ route('admin.pendaftaran.update', $pendaftaran->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="disetujui">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Setujui Pendaftaran
                    </button>
                </form>
            @endif

            <a href="{{ route('admin.pendaftaran.index') }}"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
