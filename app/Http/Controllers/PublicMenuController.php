<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PublicMenuController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');

        $query = Menu::where('status', 'tersedia')
            ->where('stok', '>', 0);

        if ($kategori && $kategori !== 'Semua') {
            $query->where('kategori', $kategori);
        }

        $menus = $query->orderBy('nama_menu')->get();

        $kategoriMenu = Menu::where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $pengaturan = Pengaturan::first();

        return view('public.menu', compact(
            'menus',
            'kategoriMenu',
            'kategori',
            'pengaturan'
        ));   
    }
    public function show($id)
{
    $menu = Menu::where('status', 'tersedia')
        ->where('stok', '>', 0)
        ->findOrFail($id);

    return view('public.detail-menu', compact('menu'));
}
}