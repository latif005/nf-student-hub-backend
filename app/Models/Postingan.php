<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'konten', 'image', 'likes_count'];

    // Relasi Penulis
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi ke Tabel Likes (Untuk cek status like)
    public function likes()
    {
        return $this->hasMany(Like::class, 'postingan_id');
    }

    // Relasi ke Tabel Komentar (Untuk hitung jumlah komentar)
    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'postingan_id');
    }
}