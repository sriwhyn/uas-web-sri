@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-inter">
    <div class="max-w-4xl w-full bg-white p-8 rounded-xl shadow-lg text-center space-y-6">
        <h1 class="text-4xl font-extrabold text-gray-900">
            Selamat Datang, Admin!
        </h1>
        <p class="mt-4 text-lg text-gray-700">
            Ini adalah halaman dashboard admin Anda. Di sini Anda dapat mengelola semua aspek aplikasi.
        </p>
        <div class="mt-8">
            <p class="text-sm text-gray-500">
                Gunakan menu navigasi di samping (atau atas, tergantung layout Anda) untuk mengakses fitur-fitur administrasi.
            </p>
        </div>
    </div>
</div>
@endsection
