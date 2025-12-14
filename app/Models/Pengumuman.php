<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi
    protected $fillable = ['judul', 'konten', 'id_user'];

    // Relasi ke User (Penulis)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}