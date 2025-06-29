<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sri_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('sri_kategori')->onDelete('cascade');
            $table->string('judul');
            $table->string('gambar')->nullable();
            $table->text('deskripsi');
            $table->date('tanggal_pelaksanaan');
            $table->string('lokasi');
            $table->integer('kuota')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sri_event');
    }
};
