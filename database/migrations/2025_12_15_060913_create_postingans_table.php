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
        Schema::create('postingans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->text('konten');          // Isi status (Wajib)
            $table->string('image')->nullable(); // Foto (Opsional)
            $table->integer('likes_count')->default(0); // Persiapan buat fitur Like nanti
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postingans');
    }
};
