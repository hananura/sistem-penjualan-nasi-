<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'harga',
        'kategori',
        'foto',
        'stok',
        'status',
    ];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}