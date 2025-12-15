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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('kode_matkul'); // Misal: TI-101
            $table->string('nama_matkul'); // Misal: Pemrograman Web
            $table->string('hari');        // Misal: Senin
            $table->string('jam');         // Misal: 08:00 - 10:00
            $table->string('ruangan');     // Misal: Lab Komputer 1
            $table->string('dosen_pengampu'); // Nama dosen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
