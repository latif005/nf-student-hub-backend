<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukt extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'periode', 'nominal', 'status'];

    public function user()
    {
        // Relasi: (Model, Foreign Key, Local Key)
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}