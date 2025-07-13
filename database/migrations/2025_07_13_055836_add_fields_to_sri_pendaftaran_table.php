<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('sri_pendaftaran', function (Blueprint $table) {
            $table->string('nama')->after('event_id');
            $table->string('nim')->nullable()->after('nama');
            $table->string('jurusan')->nullable()->after('nim');
            $table->string('prodi')->nullable()->after('jurusan');
            $table->string('institusi')->nullable()->after('prodi');
            $table->string('status_pendaftaran')->default('mahasiswa')->after('institusi'); // mahasiswa / umum

            // Jika kolom `status` belum ada, baru ditambahkan
            if (!Schema::hasColumn('sri_pendaftaran', 'status')) {
                $table->string('status')->default('terdaftar')->after('status_pendaftaran');
            }
        });
    }

    public function down(): void {
        Schema::table('sri_pendaftaran', function (Blueprint $table) {
            $table->dropColumn([
                'nama',
                'nim',
                'jurusan',
                'prodi',
                'institusi',
                'status_pendaftaran',
                'status'
            ]);
        });
    }
};
