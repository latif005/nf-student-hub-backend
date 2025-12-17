<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // 👇 WAJIB ADA: Karena kita pakai 'id_user', bukan 'id'
    protected $primaryKey = 'id_user';
    public $incrementing = true;    // Pastikan ini true (default)
    protected $keyType = 'int';     // Pastikan ini int

    protected $fillable = [
        'username',
        'nama_lengkap',
        'email',
        'password',
        'role',
        'nim',    // Pastikan ini ada
        'prodi',  // Pastikan ini ada
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}