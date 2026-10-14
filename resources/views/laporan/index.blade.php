```php
@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')

<style>
    /* ==============================
       TAMPILAN UTAMA LAPORAN
    ============================== */

    .report-page .page-title {
        margin-bottom: 25px;
    }

    .report-page .page-title h1 {
        color: #63391f;
        margin-bottom: 8px;
    }

    .report-page .page-title p {
        color: #89796e;
    }

    .report-page .report-card {
        background: #fff;
        border: 1px solid #f0e4da;
        border-radius: 16px;
        padding: 22px;
        margin-top: 24px;
        box-shadow: 0 6px 24px rgba(80, 48, 27, .04);
    }

    .report-page .report-header {
        margin-bottom: 20px;
    }

    .report-page .report-header h2 {
        color: #63391f;
        font-size: 20px;
        margin: 0 0 6px;
    }

    .report-page .report-header p {
        color: #89796e;
        font-size: 13px;
        margin: 0;
        line-height: 1.6;
    }

    /* ==============================
       TOMBOL CETAK
    ============================== */

    .report-page .print-button {
        display: inline-block;
        margin-top: 12px;
        padding: 11px 18px;
        border: none;
        border-radius: 9px;
        background: #96502d;
        color: white;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
    }

    .report-page .print-button:hover {
        background: #783d21;
    }

    /* ==============================
       TABEL LAPORAN
    ============================== */

    .report-page .table-wrapper {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #eee5de;
        border-radius: 12px;
    }

    .report-page table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
        border: 1px solid #eee5de;
    }

    .report-page th,
    .report-page td {
        border: 1px solid #eadbce;
    }

    .report-page th {
        background: #f8eee5;
        color: #69432c;
        text-align: left;
        padding: 13px 12px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .report-page td {
        padding: 14px 12px;
        color: #55473e;
        font-size: 12px;
        line-height: 1.6;
        vertical-align: top;
    }

    .report-page tbody tr:nth-child(even) {
        background: #fffdfb;
    }

    .report-page tbody tr:hover {
        background: #fff5eb;
    }

    .report-page .transaction-code {
        color: #96502d;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .report-page .menu-detail {
        margin-bottom: 10px;
    }

    .report-page .menu-detail:last-child {
        margin-bottom: 0;
    }

    .report-page .menu-name {
        display: block;
        color: #63391f;
        font-weight: 600;
    }

    .report-page .menu-subtotal {
        color: #96502d;
        font-weight: 600;
    }

    .report-page .report-total {
        color: #63391f;
        font-weight: 700;
        white-space: nowrap;
    }

    .report-page .paid-badge {
        display: inline-block;
        background: #dcf5e4;
        color: #237a43;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .report-page .empty-report {
        text-align: center;
        padding: 40px 15px;
        color: #89796e;
    }

    .report-page .empty-report strong {
        display: block;
        color: #63391f;
        margin: 10px 0 5px;
        font-size: 15px;
    }

    /* ==============================
       RESPONSIVE HP
    ============================== */

    @media (max-width: 600px) {
        .report-page .report-card {
            padding: 15px;
        }

        .report-page .report-header h2 {
            font-size: 18px;
        }

        .report-page .table-wrapper table {
            min-width: 900px;
        }
    }

    /* ==============================
       CETAK / SIMPAN PDF
    ============================== */

    @media print {

        @page {
            size: A4 landscape;
            margin: 12mm;
        }

        body * {
            visibility: hidden !important;
        }

        .report-page,
        .report-page * {
            visibility: visible !important;
        }

        .report-page {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
            color: #222;
            font-family: Arial, sans-serif;
        }

        .report-page .print-button {
            display: none !important;
        }

        .report-page .page-title {
            margin-bottom: 15px;
        }

        .report-page .page-title h1 {
            font-size: 22px;
            color: #222;
        }

        .report-page .page-title p {
            font-size: 11px;
            color: #444;
        }

        .report-page .report-card {
            margin-top: 15px;
            padding: 0;
            border: none;
            border-radius: 0;
            box-shadow: none;
            background: white;
        }

        .report-page .report-header {
            margin-bottom: 10px;
        }

        .report-page .report-header h2 {
            font-size: 15px;
            color: #222;
        }

        .report-page .report-header p {
            font-size: 10px;
            color: #444;
        }

        /* PERBAIKAN GARIS LUAR TABEL */

        .report-page .table-wrapper {
            display: block;
            width: 100%;
            overflow: visible;
            border: 1px solid #999;
            border-radius: 0;
            box-sizing: border-box;
        }

        .report-page table {
            display: table;
            width: 100%;
            min-width: 0;
            table-layout: fixed;
            border-collapse: collapse;
            border: 1px solid #999;
            margin: 0;
        }

        .report-page thead {
            display: table-header-group;
        }

        .report-page tbody {
            display: table-row-group;
        }

        .report-page tr {
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .report-page th,
        .report-page td {
            padding: 6px;
            font-size: 9px;
            color: #222;
            border: 1px solid #999 !important;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            box-sizing: border-box;
        }

        .report-page th {
            background: #f1e4d8 !important;
            color: #222;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }

        /* PASTIKAN GARIS BARIS TERAKHIR TETAP MUNCUL */

        .report-page tbody tr:last-child td {
            border-bottom: 1px solid #999 !important;
        }

        .report-page .transaction-code,
        .report-page .menu-name,
        .report-page .menu-subtotal,
        .report-page .report-total {
            color: #222;
        }

        .report-page .paid-badge {
            background: #eee !important;
            color: #222;
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }

        .report-page .menu-detail {
            break-inside: avoid;
            page-break-inside: avoid;
            margin-bottom: 5px;
        }

        .report-page .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 8px;
        }

        .report-page .stat-card {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: none;
            background: white;
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .report-page .stat-info span,
        .report-page .stat-info small {
            font-size: 9px;
        }

        .report-page .stat-info strong {
            font-size: 13px;
            color: #222;
            overflow-wrap: anywhere;
        }

        .report-page .stat-icon {
            display: none;
        }

        .report-page .empty-report {
            padding: 20px 8px;
        }
    }
</style>

<div class="report-page">

    {{-- JUDUL LAPORAN --}}
    <div class="page-title">
        <h1>Laporan Penjualan</h1>

        <p>
            Ringkasan transaksi selesai dan lunas di Nasi Ibu.
        </p>

        <button
            type="button"
            class="print-button"
            onclick="window.print()">
            🖨️ Cetak / Simpan PDF
        </button>
    </div>

    {{-- RINGKASAN PENJUALAN --}}
    <div class="stats">

        <div class="stat-card">
            <div class="stat-info">
                <span>Total Transaksi</span>
                <strong>{{ $jumlahTransaksi }}</strong>
                <small>Transaksi selesai dan lunas</small>
            </div>
            <div class="stat-icon">🧾</div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <span>Total Penjualan</span>
                <strong>
                    Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                </strong>
                <small>Omzet tercatat</small>
            </div>
            <div class="stat-icon">💰</div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <span>Transaksi Hari Ini</span>
                <strong>{{ $transaksiHariIni }}</strong>
                <small>Transaksi selesai dan lunas</small>
            </div>
            <div class="stat-icon">📅</div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <span>Penjualan Hari Ini</span>
                <strong>
                    Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}
                </strong>
                <small>Omzet hari ini</small>
            </div>
            <div class="stat-icon">📈</div>
        </div>

    </div>

    {{-- TABEL RIWAYAT PENJUALAN --}}
    <div class="card report-card">

        <div class="report-header">
            <h2>Riwayat Penjualan</h2>
            <p>
                Rincian menu dan pembayaran untuk transaksi
                yang selesai dan lunas.
            </p>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Rincian Menu</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($dataPenjualan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="transaction-code">
                                    {{ $item->kode_transaksi }}
                                </span>
                            </td>

                            <td>
                                {{ $item->nama_pelanggan ?? 'Pelanggan Umum' }}
                            </td>

                            <td>
                                @forelse($item->detailPenjualan as $detail)
                                    <div class="menu-detail">
                                        <span class="menu-name">
                                            {{ $detail->menu->nama_menu ?? 'Menu tidak tersedia' }}
                                        </span>

                                        {{ $detail->jumlah }} porsi ×
                                        Rp {{ number_format($detail->harga, 0, ',', '.') }}

                                        <br>

                                        <span class="menu-subtotal">
                                            Subtotal:
                                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @empty
                                    <span style="color:#999;">
                                        Tidak ada rincian menu
                                    </span>
                                @endforelse
                            </td>

                            <td>
                                <span class="report-total">
                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                @if($item->pembayaran)
                                    <span class="paid-badge">Lunas</span>
                                    <br>
                                    <span style="display:inline-block;margin-top:6px;">
                                        {{ strtoupper($item->pembayaran->metode_pembayaran) }}
                                    </span>
                                @else
                                    <span style="color:#999;">
                                        Belum tercatat
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $item->created_at?->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-report">
                                    <div style="font-size:38px;">📊</div>

                                    <strong>
                                        Belum ada data penjualan
                                    </strong>

                                    Transaksi akan muncul setelah berstatus
                                    selesai dan pembayaran tercatat lunas.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
```