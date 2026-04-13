<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar Laravel mengizinkan pengisian data:
    protected $fillable = [
        'nama_lengkap',
        'no_whatsapp',
        'umur',
        'sabuk',
        'status'
    ];
}
