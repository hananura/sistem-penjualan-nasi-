<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';

    protected $fillable = [
    'kode_transaksi',
    'user_id',
    'nama_pelanggan',
    'no_whatsapp',
    'alamat_pelanggan',
    'total_harga',
    'status',
    'catatan',
];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
