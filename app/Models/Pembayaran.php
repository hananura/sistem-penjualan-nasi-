<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'penjualan_id',
        'metode_pembayaran',
        'jumlah_bayar',
        'kembalian',
        'status_pembayaran',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}