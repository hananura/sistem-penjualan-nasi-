
@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="page-title">
    <h1>Dashboard</h1>
    <p>
        Selamat datang kembali,
        {{ auth()->user()->nama ?? 'Admin' }}!
    </p>
</div>

{{-- ================= STATISTIK ================= --}}

<div class="stats">

    <div class="stat-card">
        <div class="stat-info">
            <span>Menu Tersedia</span>
            <strong>{{ $jumlahMenu }}</strong>
        </div>
        <div class="stat-icon">🍚</div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <span>Total Transaksi</span>
            <strong>{{ $jumlahPenjualan }}</strong>
        </div>
        <div class="stat-icon">🧾</div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <span>Pendapatan</span>
            <strong style="font-size: 18px;">
                Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
            </strong>
        </div>
        <div class="stat-icon">💰</div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <span>Pesanan Selesai</span>
            <strong>{{ $jumlahSelesai }}</strong>
        </div>
        <div class="stat-icon">✓</div>
    </div>

</div>

{{-- ================= PESANAN TERBARU ================= --}}

<div class="card">

    <div class="card-header">
        <div>
            <h2>Pesanan Terbaru</h2>
            <p>Pantau transaksi terbaru pelanggan.</p>
        </div>

        <a href="/penjualan" class="btn btn-primary">
            Lihat Semua
        </a>
    </div>

    <div class="table-wrapper"
         style="overflow-x: auto; border-radius: 14px;">

        <table style="
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #f0e2d7;
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
        ">

            <thead>
                <tr style="background: #f8eee5;">

                    <th style="padding: 18px 16px; text-align: left;
                               color: #70401f; white-space: nowrap;">
                        Kode Transaksi
                    </th>

                    <th style="padding: 18px 16px; text-align: left;
                               color: #70401f;">
                        Pelanggan
                    </th>

                    <th style="padding: 18px 16px; text-align: left;
                               color: #70401f; white-space: nowrap;">
                        Total
                    </th>

                    <th style="padding: 18px 16px; text-align: left;
                               color: #70401f;">
                        Status
                    </th>

                    <th style="padding: 18px 16px; text-align: left;
                               color: #70401f; white-space: nowrap;">
                        Tanggal
                    </th>

                </tr>
            </thead>

            <tbody>

                @forelse($pesananTerbaru as $penjualan)

                    <tr style="background: #fff;">

                        <td style="
                            padding: 18px 16px;
                            border-top: 1px solid #f0e2d7;
                            overflow-wrap: anywhere;
                        ">
                            <strong>
                                {{ $penjualan->kode_transaksi }}
                            </strong>
                        </td>

                        <td style="
                            padding: 18px 16px;
                            border-top: 1px solid #f0e2d7;
                        ">
                            {{ $penjualan->nama_pelanggan ?? 'Pelanggan' }}
                        </td>

                        <td style="
                            padding: 18px 16px;
                            border-top: 1px solid #f0e2d7;
                            white-space: nowrap;
                        ">
                            <strong>
                                Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}
                            </strong>
                        </td>

                        <td style="
                            padding: 18px 16px;
                            border-top: 1px solid #f0e2d7;
                        ">

                            @if($penjualan->status === 'selesai')

                                <span class="status status-success">
                                    Selesai
                                </span>

                            @elseif($penjualan->status === 'dibatalkan')

                                <span class="status status-danger">
                                    Dibatalkan
                                </span>

                            @elseif($penjualan->status === 'diproses')

                                <span class="status"
                                      style="background: #dbeafe; color: #1d4ed8;">
                                    Diproses
                                </span>

                            @else

                                <span class="status"
                                      style="background: #fff0c2; color: #946200;">
                                    Menunggu
                                </span>

                            @endif

                        </td>

                        <td style="
                            padding: 18px 16px;
                            border-top: 1px solid #f0e2d7;
                            white-space: nowrap;
                        ">
                            {{ $penjualan->created_at?->format('d/m/Y H:i') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" style="
                            text-align: center;
                            padding: 35px;
                            color: #999;
                            border-top: 1px solid #f0e2d7;
                        ">
                            Belum ada transaksi.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- ================= MENU TERSEDIA ================= --}}

<div class="card">

    <div class="card-header">
        <div>
            <h2>Menu Tersedia</h2>
            <p>Daftar makanan yang tersedia.</p>
        </div>

        <a href="/menu" class="btn btn-primary">
            Kelola Menu
        </a>
    </div>

    <div class="menu-list">

        @forelse($menuTerbaru as $menu)

            <div class="menu-item">

                <div class="menu-item-info">
                    <strong>{{ $menu->nama_menu }}</strong>

                    <span>
                        {{ $menu->kategori }}
                        · Stok {{ $menu->stok }}
                    </span>
                </div>

                <strong>
                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                </strong>

            </div>

        @empty

            <div style="
                grid-column: 1 / -1;
                text-align: center;
                padding: 30px;
                color: #999;
            ">
                Belum ada menu.
            </div>

        @endforelse

    </div>

</div>

@endsection
