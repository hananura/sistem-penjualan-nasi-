@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')

<style>
    .detail-page {
        color: #554438;
    }

    .detail-page .detail-card {
        padding: 24px;
        border: 1px solid #f0e4da;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 6px 24px rgba(80, 48, 27, .04);
        margin-bottom: 22px;
    }

    .detail-page .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin: 22px 0;
    }

    .detail-page .info-box {
        padding: 18px;
        background: #fffaf3;
        border: 1px solid #f0e4da;
        border-radius: 12px;
        min-width: 0;
    }

    .detail-page .info-label {
        display: block;
        color: #89796e;
        font-size: 12px;
        margin-bottom: 7px;
    }

    .detail-page .info-value {
        display: block;
        color: #63391f;
        font-size: 14px;
        font-weight: 600;
        overflow-wrap: anywhere;
        line-height: 1.7;
    }

    .detail-page .section-title {
        color: #63391f;
        font-size: 18px;
        margin: 0 0 16px;
    }

    .detail-page .status {
        display: inline-block;
        border-radius: 30px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .detail-page .status-waiting {
        background: #fff0c9;
        color: #8a5a00;
    }

    .detail-page .status-processing {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .detail-page .status-complete {
        background: #dcf5e4;
        color: #237a43;
    }

    .detail-page .status-cancelled {
        background: #fee2e2;
        color: #b42318;
    }

    .detail-page .payment-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        padding: 12px 0;
        border-bottom: 1px solid #f0e8e1;
    }

    .detail-page .payment-row:last-child {
        border-bottom: none;
    }

    .detail-page .payment-row strong {
        text-align: right;
        overflow-wrap: anywhere;
    }

    @media (max-width: 600px) {
        .detail-page .detail-card {
            padding: 16px;
        }

        .detail-page .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-page .detail-header {
            align-items: flex-start !important;
        }

        .detail-page .payment-row {
            font-size: 13px;
        }
    }
</style>

<div class="detail-page">

    <div class="page-title">
        <h1>Detail Pesanan</h1>
        <p>
            Informasi lengkap transaksi
            {{ $penjualan->kode_transaksi }}.
        </p>
    </div>

    {{-- Informasi utama transaksi --}}
    <div class="card detail-card">

        <div class="card-header detail-header">
            <div>
                <h2>{{ $penjualan->kode_transaksi }}</h2>
                <p>
                    {{ $penjualan->created_at->format('d/m/Y H:i') }}
                </p>
            </div>

            <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                @if(
                    $penjualan->pembayaran &&
                    $penjualan->pembayaran->status_pembayaran === 'lunas'
                )
                    <span class="status status-complete">
                        Lunas
                    </span>
                @else
                    <a href="/penjualan/{{ $penjualan->id }}/payment"
                       class="btn btn-success">
                        Pembayaran
                    </a>
                @endif

                <a href="/penjualan" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </div>

        {{-- Status pesanan --}}
        <div style="margin-top:20px;">
            <span class="info-label">Status Pesanan</span>

            @if($penjualan->status === 'menunggu')
                <span class="status status-waiting">Menunggu</span>
            @elseif($penjualan->status === 'diproses')
                <span class="status status-processing">Diproses</span>
            @elseif($penjualan->status === 'selesai')
                <span class="status status-complete">Selesai</span>
            @elseif($penjualan->status === 'dibatalkan')
                <span class="status status-cancelled">Dibatalkan</span>
            @else
                <span class="status">
                    {{ ucfirst($penjualan->status) }}
                </span>
            @endif
        </div>

        {{-- Informasi pelanggan --}}
        <h3 class="section-title" style="margin-top:25px;">
            Informasi Pelanggan
        </h3>

        <div class="detail-grid">

            <div class="info-box">
                <span class="info-label">Nama Pelanggan</span>
                <span class="info-value">
                    {{ $penjualan->nama_pelanggan ?? 'Pelanggan Umum' }}
                </span>
            </div>

            <div class="info-box">
                <span class="info-label">Nomor WhatsApp</span>
                <span class="info-value">
                    {{ $penjualan->no_whatsapp ?? 'Belum tersedia' }}
                </span>
            </div>

            <div class="info-box">
                <span class="info-label">Alamat Pengantaran</span>
                <span class="info-value">
                    {{ $penjualan->alamat_pelanggan ?? 'Tidak diisi' }}
                </span>
            </div>

            <div class="info-box">
                <span class="info-label">Kasir</span>
                <span class="info-value">
                    {{ $penjualan->user->nama ?? 'Pelanggan Online' }}
                </span>
            </div>

        </div>

        {{-- Detail menu --}}
        <h3 class="section-title">Rincian Pesanan</h3>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($penjualan->detailPenjualan as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>
                                    {{ $detail->menu->nama_menu ?? 'Menu tidak tersedia' }}
                                </strong>
                            </td>

                            <td>
                                Rp {{ number_format($detail->harga, 0, ',', '.') }}
                            </td>

                            <td>{{ $detail->jumlah }}</td>

                            <td>
                                <strong>
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </strong>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Total --}}
        <div style="display:flex;justify-content:flex-end;margin-top:20px;">
            <div style="width:300px;max-width:100%;">
                <div class="payment-row">
                    <span>Total Pesanan</span>
                    <strong style="font-size:19px;color:#7b4526;">
                        Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}
                    </strong>
                </div>
            </div>
        </div>

        {{-- Catatan pelanggan --}}
        @if($penjualan->catatan)
            <div class="info-box" style="margin-top:20px;">
                <span class="info-label">Catatan Pesanan</span>
                <span class="info-value" style="font-weight:400;">
                    {{ $penjualan->catatan }}
                </span>
            </div>
        @endif

    </div>

    {{-- Informasi pembayaran --}}
    @if($penjualan->pembayaran)
        <div class="card detail-card">

            <h3 class="section-title">
                Informasi Pembayaran
            </h3>

            <div class="payment-row">
                <span>Metode Pembayaran</span>
                <strong>
                    {{ strtoupper($penjualan->pembayaran->metode_pembayaran) }}
                </strong>
            </div>

            <div class="payment-row">
                <span>Jumlah Bayar</span>
                <strong>
                    Rp {{ number_format($penjualan->pembayaran->jumlah_bayar, 0, ',', '.') }}
                </strong>
            </div>

            <div class="payment-row">
                <span>Kembalian</span>
                <strong>
                    Rp {{ number_format($penjualan->pembayaran->kembalian, 0, ',', '.') }}
                </strong>
            </div>

            <div class="payment-row">
                <span>Status Pembayaran</span>
                <strong>
                    {{ ucfirst(str_replace('_', ' ', $penjualan->pembayaran->status_pembayaran)) }}
                </strong>
            </div>

        </div>
    @endif

</div>

@endsection