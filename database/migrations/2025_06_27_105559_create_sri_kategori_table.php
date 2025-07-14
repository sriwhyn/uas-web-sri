<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('sri_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori')->unique(); 
            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('sri_kategori');
    }
};
