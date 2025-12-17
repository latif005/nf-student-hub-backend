<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ukts', function (Blueprint $table) {
            $table->id();
            // Relasi ke id_user
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('periode');
            $table->decimal('nominal', 15, 2);
            $table->string('status'); // Belum Bayar, Verifikasi, Lunas
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ukts');
    }
};