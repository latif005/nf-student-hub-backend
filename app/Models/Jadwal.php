<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_matkul',
        'nama_matkul',
        'hari',
        'jam',
        'ruangan',
        'dosen_pengampu'
    ];
}