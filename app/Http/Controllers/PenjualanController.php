<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Menu;
use App\Models\DetailPenjualan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PenjualanController extends Controller
{
    // ==========================================
    // DAFTAR PENJUALAN
    // ==========================================
    public function index()
    {
        $penjualan = Penjualan::with('user')
            ->latest()
            ->get();

        return view('penjualan.index', compact('penjualan'));
    }

    // ==========================================
    // FORM BUAT PESANAN KASIR
    // ==========================================
    public function create()
    {
        $menus = Menu::where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->orderBy('nama_menu')
            ->get();

        return view('penjualan.create', compact('menus'));
    }

    // ==========================================
    // SIMPAN TRANSAKSI KASIR
    // ==========================================
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pelanggan' => 'nullable|string|max:100',
            'menu_id' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $penjualan = DB::transaction(function () use ($data) {
            // Kunci data menu agar stok diperiksa secara aman.
            $menu = Menu::whereKey($data['menu_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $menu->status !== 'tersedia' ||
                $menu->stok < $data['jumlah']
            ) {
                throw ValidationException::withMessages([
                    'jumlah' =>
                        'Stok menu tidak mencukupi. Silakan periksa kembali.',
                ]);
            }

            $subtotal = $menu->harga * $data['jumlah'];

            $penjualan = Penjualan::create([
                'kode_transaksi' => 'TRX-' .
                    now()->format('YmdHis') . '-' .
                    strtoupper(\Illuminate\Support\Str::random(5)),

                // Menggunakan akun yang sedang login.
                'user_id' => auth()->id(),

                'nama_pelanggan' => $data['nama_pelanggan'] ?? null,
                'total_harga' => $subtotal,
                'status' => 'selesai',
                'catatan' => $data['catatan'] ?? null,
            ]);

            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'menu_id' => $menu->id,
                'jumlah' => $data['jumlah'],
                'harga' => $menu->harga,
                'subtotal' => $subtotal,
            ]);

            // Kurangi stok menu.
            $menu->stok -= $data['jumlah'];

            if ($menu->stok <= 0) {
                $menu->stok = 0;
                $menu->status = 'habis';
            }

            $menu->save();

            return $penjualan;
        });

        return redirect('/penjualan')
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    // ==========================================
    // DETAIL TRANSAKSI
    // ==========================================
    public function show($id)
    {
        $penjualan = Penjualan::with([
            'user',
            'detailPenjualan.menu',
            'pembayaran',
        ])->findOrFail($id);

        return view('penjualan.show', compact('penjualan'));
    }

    // ==========================================
    // FORM PEMBAYARAN
    // ==========================================
    public function payment($id)
    {
        $penjualan = Penjualan::with('pembayaran')
            ->findOrFail($id);

        return view('penjualan.payment', compact('penjualan'));
    }

    // ==========================================
    // SIMPAN PEMBAYARAN
    // ==========================================
    public function storePayment(Request $request, $id)
    {
        $data = $request->validate([
            'metode_pembayaran' => 'required|in:tunai,transfer,qris',
            'jumlah_bayar' => 'required|numeric|min:0',
        ]);

        $penjualan = Penjualan::findOrFail($id);

        if ($penjualan->pembayaran) {
            return back()->withErrors([
                'pembayaran' =>
                    'Transaksi ini sudah memiliki pembayaran.',
            ]);
        }

        if ($data['jumlah_bayar'] < $penjualan->total_harga) {
            return back()
                ->withErrors([
                    'jumlah_bayar' =>
                        'Jumlah pembayaran kurang dari total tagihan.',
                ])
                ->withInput();
        }

        $kembalian = $data['jumlah_bayar']
            - $penjualan->total_harga;

        Pembayaran::create([
            'penjualan_id' => $penjualan->id,
            'metode_pembayaran' => $data['metode_pembayaran'],
            'jumlah_bayar' => $data['jumlah_bayar'],
            'kembalian' => $kembalian,
            'status_pembayaran' => 'lunas',
        ]);

        return redirect('/penjualan/' . $penjualan->id)
            ->with('success', 'Pembayaran berhasil disimpan!');
    }

    // ==========================================
    // DAFTAR PELANGGAN
    // ==========================================
    public function pelanggan()
    {
        $pelanggan = Penjualan::whereNotNull('nama_pelanggan')
            ->where('nama_pelanggan', '!=', '')
            ->select('nama_pelanggan')
            ->selectRaw('COUNT(*) as jumlah_transaksi')
            ->selectRaw('SUM(total_harga) as total_belanja')
            ->groupBy('nama_pelanggan')
            ->orderBy('nama_pelanggan')
            ->get();

        return view('pelanggan.index', compact('pelanggan'));
    }

    // ==========================================
    // LAPORAN PENJUALAN
    // Hanya transaksi selesai dan sudah lunas.
    // ==========================================
    public function laporan()
    {
        $queryLaporan = Penjualan::where('status', 'selesai')
            ->whereHas('pembayaran', function ($query) {
                $query->where('status_pembayaran', 'lunas');
            });

        // Total transaksi yang selesai dan lunas.
        $jumlahTransaksi = (clone $queryLaporan)->count();

        // Total omzet transaksi selesai dan lunas.
        $totalPenjualan = (clone $queryLaporan)
            ->sum('total_harga');

        // Jumlah transaksi selesai dan lunas hari ini.
        $transaksiHariIni = (clone $queryLaporan)
            ->whereDate('created_at', today())
            ->count();

        // Omzet transaksi selesai dan lunas hari ini.
        $penjualanHariIni = (clone $queryLaporan)
            ->whereDate('created_at', today())
            ->sum('total_harga');

        // Memuat pembayaran dan rincian menu untuk tabel laporan.
        $dataPenjualan = (clone $queryLaporan)
            ->with([
                'pembayaran',
                'detailPenjualan.menu',
            ])
            ->latest()
            ->get();

        return view('laporan.index', compact(
            'jumlahTransaksi',
            'totalPenjualan',
            'transaksiHariIni',
            'penjualanHariIni',
            'dataPenjualan'
        ));
    }

    // ==========================================
    // UBAH STATUS PESANAN ONLINE
    // ==========================================
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,selesai,dibatalkan',
        ]);

        $statusBaru = $request->input('status');

        $berhasil = DB::transaction(function () use ($id, $statusBaru) {
            $penjualan = Penjualan::with('detailPenjualan')
                ->lockForUpdate()
                ->findOrFail($id);

            // Menunggu menjadi diproses.
            if (
                $statusBaru === 'diproses' &&
                $penjualan->status !== 'menunggu'
            ) {
                return false;
            }

            // Diproses menjadi selesai.
            if (
                $statusBaru === 'selesai' &&
                $penjualan->status !== 'diproses'
            ) {
                return false;
            }

            // Batalkan pesanan aktif dan kembalikan stok.
            if ($statusBaru === 'dibatalkan') {
                if (!in_array($penjualan->status, [
                    'menunggu',
                    'diproses',
                ])) {
                    return false;
                }

                foreach ($penjualan->detailPenjualan as $detail) {
                    $menu = Menu::whereKey($detail->menu_id)
                        ->lockForUpdate()
                        ->first();

                    if ($menu) {
                        $menu->stok += $detail->jumlah;
                        $menu->status = 'tersedia';
                        $menu->save();
                    }
                }
            }

            $penjualan->status = $statusBaru;
            $penjualan->save();

            return true;
        });

        if (!$berhasil) {
            return redirect('/penjualan')
                ->with(
                    'error',
                    'Perubahan status pesanan tidak valid.'
                );
        }

        return redirect('/penjualan')
            ->with(
                'success',
                'Status pesanan berhasil diubah menjadi ' .
                    ucfirst($statusBaru) . '.'
            );
    }
}