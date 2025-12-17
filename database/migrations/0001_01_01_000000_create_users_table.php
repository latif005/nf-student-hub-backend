<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('users', function (Blueprint $table) {
        $table->id('id_user'); // Primary Key kita
        $table->string('username')->unique();
        $table->string('password');
        $table->string('nama_lengkap');
        $table->string('role');
        $table->string('email')->unique();
        
        // 👇 INI YANG KEMARIN HILANG (WAJIB ADA)
        $table->string('nim')->nullable();
        $table->string('prodi')->nullable();
        
        $table->rememberToken();
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};