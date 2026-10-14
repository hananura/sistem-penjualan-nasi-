<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = [
        'nama_usaha',
        'nama_pemilik',
        'no_hp',
        'alamat',
        'deskripsi',
    ];
}