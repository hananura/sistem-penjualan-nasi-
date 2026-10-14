<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicOrderController extends Controller
{
    public function create($id)
    {
        $menu = Menu::where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->findOrFail($id);

        return view('public.pesan', compact('menu'));
    }
public function store(Request $request)
{
    $data = $request->validate([
        'menu_id' => 'required|exists:menus,id',
        'nama_pelanggan' => 'required|string|max:100',
        'no_whatsapp' => 'required|string|max:25',
        'alamat_pelanggan' => 'nullable|string|max:1000',
        'jumlah' => 'required|integer|min:1',
        'catatan' => 'nullable|string|max:1000',
    ]);

    $penjualan = DB::transaction(function () use ($data) {
        $menu = Menu::whereKey($data['menu_id'])
            ->lockForUpdate()
            ->firstOrFail();

        if (
            $menu->status !== 'tersedia' ||
            $menu->stok < $data['jumlah']
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'jumlah' => 'Stok menu tidak mencukupi. Silakan pilih jumlah lain.',
            ]);
        }

        $subtotal = $menu->harga * $data['jumlah'];

        $penjualan = Penjualan::create([
            'kode_transaksi' => 'TRX-' .
                now()->format('YmdHis') . '-' .
                strtoupper(\Illuminate\Support\Str::random(5)),
            'user_id' => null,
            'nama_pelanggan' => $data['nama_pelanggan'],
            'no_whatsapp' => $data['no_whatsapp'],
            'alamat_pelanggan' => $data['alamat_pelanggan'] ?? null,
            'total_harga' => $subtotal,
            'status' => 'menunggu',
            'catatan' => $data['catatan'] ?? null,
        ]);

        DetailPenjualan::create([
            'penjualan_id' => $penjualan->id,
            'menu_id' => $menu->id,
            'jumlah' => $data['jumlah'],
            'harga' => $menu->harga,
            'subtotal' => $subtotal,
        ]);

        $menu->stok -= $data['jumlah'];

        if ($menu->stok <= 0) {
            $menu->status = 'habis';
        }

        $menu->save();

        return $penjualan;
    });

    return redirect()->route(
        'public.order.success',
        $penjualan->id
    );
}
    public function success($id)
    {
        $penjualan = Penjualan::with('detailPenjualan.menu')
            ->findOrFail($id);

        return view('public.pesanan-berhasil', compact('penjualan'));
    }
}
