<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('sri_event', function (Blueprint $table) {
            $table->string('penyelenggara')->nullable()->after('lokasi');
        });
    }


    public function down()
    {
        Schema::table('sri_event', function (Blueprint $table) {
            $table->dropColumn('penyelenggara');
        });
    }
};
