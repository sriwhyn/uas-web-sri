<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sri_pendaftaran', function (Blueprint $table) {
            $table->string('nama')->after('event_id');
            $table->string('nim')->after('nama');
            $table->string('jurusan')->after('nim');
            $table->string('prodi')->after('jurusan');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sri_pendaftaran', function (Blueprint $table) {
            $table->dropColumn(['nama', 'nim', 'jurusan', 'prodi']);
        });
    }
};
