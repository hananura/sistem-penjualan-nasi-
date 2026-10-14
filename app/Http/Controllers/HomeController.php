<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pengaturan;

class HomeController extends Controller
{
    public function index()
    {
        $menuFavorit = Menu::where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->latest()
            ->take(4)
            ->get();

        $pengaturan = Pengaturan::first();

        return view('home', compact(
            'menuFavorit',
            'pengaturan'
        ));
    }
}