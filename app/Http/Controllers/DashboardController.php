<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Penjualan;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah menu yang tersedia
        $jumlahMenu = Menu::where('status', 'tersedia')->count();

        // Total seluruh transaksi
        $jumlahPenjualan = Penjualan::count();

        // Total pendapatan dari transaksi selesai
        $totalPenjualan = Penjualan::where('status', 'selesai')
            ->sum('total_harga');

        // Jumlah pesanan yang sudah selesai
        $jumlahSelesai = Penjualan::where('status', 'selesai')
            ->count();

        // 5 transaksi terbaru
        $pesananTerbaru = Penjualan::latest()
            ->take(5)
            ->get();

        // 6 menu terbaru
        $menuTerbaru = Menu::latest()
            ->take(6)
            ->get();

        return view('dashboard', compact(
            'jumlahMenu',
            'jumlahPenjualan',
            'totalPenjualan',
            'jumlahSelesai',
            'pesananTerbaru',
            'menuTerbaru'
        ));
    }
}