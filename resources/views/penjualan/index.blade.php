@extends('layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')

<style>
    .orders-page .cancel-button {
        background: #fff0f0;
        color: #b42318;
        border: 1px solid #f2caca;
    }

    .orders-page .cancel-button:hover {
        background: #fee2e2;
    }

    .orders-page .status-action-form {
        margin-top: 7px;
    }

    .orders-page .status-action-button {
        width: 100%;
        padding: 8px 10px;
        border: none;
        border-radius: 8px;
        background: #96502d;
        color: white;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
    }

    .orders-page .status-action-button:hover {
        background: #783d21;
    }

    .orders-page .page-title {
        margin-bottom: 26px;
    }

    .orders-page .page-title h1 {
        color: #63391f;
        margin-bottom: 8px;
    }

    .orders-page .orders-card {
        background: #fff;
        border: 1px solid #f0e4da;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 6px 24px rgba(80, 48, 27, .05);
    }

    .orders-page .orders-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 22px;
    }

    .orders-page .orders-header h2 {
        color: #63391f;
        margin: 0 0 6px;
        font-size: 21px;
    }

    .orders-page .orders-header p {
        color: #89796e;
        margin: 0;
        font-size: 14px;
    }

    .orders-page .table-wrapper {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #eee5de;
        border-radius: 12px;
    }

    .orders-page .table-wrapper table {
        width: 100%;
        min-width: 780px;
        table-layout: fixed;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0;
    }

    .orders-page .table-wrapper th {
        background: #f8eee5;
        color: #69432c;
        padding: 15px 10px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        text-transform: none;
        letter-spacing: .2px;
        border-bottom: 1px solid #eadbce;
    }

    .orders-page .table-wrapper td {
        padding: 16px 10px;
        color: #55473e;
        font-size: 13px;
        line-height: 1.55;
        vertical-align: middle;
        border-bottom: 1px solid #f1ece7;
        overflow-wrap: anywhere;
    }

    .orders-page .table-wrapper tbody tr:nth-child(even) {
        background: #fffdfb;
    }

    .orders-page .table-wrapper tbody tr {
        transition: background .2s;
    }

    .orders-page .table-wrapper tbody tr:hover {
        background: #fff5eb;
    }

    .orders-page .table-wrapper tbody tr:last-child td {
        border-bottom: none;
    }

    .orders-page .table-wrapper th:nth-child(1),
    .orders-page .table-wrapper td:nth-child(1) {
        width: 5%;
        text-align: center;
    }

    .orders-page .table-wrapper th:nth-child(2),
    .orders-page .table-wrapper td:nth-child(2) {
        width: 17%;
    }

    .orders-page .table-wrapper th:nth-child(3),
    .orders-page .table-wrapper td:nth-child(3) {
        width: 13%;
    }

    .orders-page .table-wrapper th:nth-child(4),
    .orders-page .table-wrapper td:nth-child(4) {
        width: 12%;
    }

    .orders-page .table-wrapper th:nth-child(5),
    .orders-page .table-wrapper td:nth-child(5) {
        width: 13%;
    }

    .orders-page .table-wrapper th:nth-child(6),
    .orders-page .table-wrapper td:nth-child(6) {
        width: 11%;
    }

    .orders-page .table-wrapper th:nth-child(7),
    .orders-page .table-wrapper td:nth-child(7) {
        width: 17%;
    }

    .orders-page .table-wrapper th:nth-child(8),
    .orders-page .table-wrapper td:nth-child(8) {
        width: 12%;
    }

    .orders-page .transaction-code {
        color: #96502d;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .orders-page .total-price {
        color: #63391f;
        font-weight: 700;
        white-space: nowrap;
    }

    .orders-page .status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        line-height: 1.3;
        white-space: nowrap;
    }

    .orders-page .status-waiting {
        background: #fff0c9;
        color: #8a5a00;
    }

    .orders-page .status-processing {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .orders-page .status-complete {
        background: #dcf5e4;
        color: #237a43;
    }

    .orders-page .status-cancelled {
        background: #fee2e2;
        color: #b42318;
    }

    .orders-page .detail-button {
        display: inline-block;
        width: 100%;
        box-sizing: border-box;
        padding: 9px 8px;
        border-radius: 8px;
        background: #96502d;
        color: white !important;
        text-decoration: none !important;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        transition: background .2s;
    }

    .orders-page .detail-button:hover {
        background: #783d21;
    }

    .orders-page .empty-orders {
        text-align: center;
        padding: 45px 18px !important;
        color: #89796e !important;
    }

    .orders-page .empty-orders .empty-icon {
        font-size: 42px;
        margin-bottom: 10px;
    }

    .orders-page .empty-orders strong {
        display: block;
        font-size: 17px;
        color: #63391f;
        margin-bottom: 7px;
    }

    @media (max-width: 600px) {
        .orders-page .orders-card {
            padding: 15px;
            border-radius: 14px;
        }

        .orders-page .orders-header h2 {
            font-size: 19px;
        }

        .orders-page .table-wrapper table {
            min-width: 780px;
        }
    }
</style>

<div class="orders-page">

    {{-- Notifikasi berhasil --}}
    @if(session('success'))
        <div style="
            background:#dcf5e4;
            color:#237a43;
            padding:12px 16px;
            border-radius:10px;
            margin-bottom:18px;
        ">
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi error --}}
    @if(session('error'))
        <div style="
            background:#fee2e2;
            color:#b42318;
            padding:12px 16px;
            border-radius:10px;
            margin-bottom:18px;
        ">
            {{ session('error') }}
        </div>
    @endif

    <div class="page-title">
        <h1>Kelola Pesanan</h1>
        <p>Lihat dan kelola semua transaksi penjualan Nasi Ibu.</p>
    </div>

    <div class="card orders-card">

        <div class="orders-header">
            <div>
                <h2>Daftar Pesanan</h2>
                <p>Semua transaksi online dan transaksi kasir.</p>
            </div>

            <a href="/penjualan/create" class="btn btn-primary">
                + Buat Pesanan
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Kasir</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($penjualan as $item)
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
                                {{ $item->user->nama ?? 'Pelanggan Online' }}
                            </td>

                            <td>
                                <span class="total-price">
                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                @if($item->status === 'menunggu')
                                    <span class="status status-waiting">
                                        Menunggu
                                    </span>
                                @elseif($item->status === 'diproses')
                                    <span class="status status-processing">
                                        Diproses
                                    </span>
                                @elseif($item->status === 'selesai')
                                    <span class="status status-complete">
                                        Selesai
                                    </span>
                                @elseif($item->status === 'dibatalkan')
                                    <span class="status status-cancelled">
                                        Dibatalkan
                                    </span>
                                @else
                                    <span class="status status-waiting">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $item->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td>
                                {{-- Tombol detail --}}
                                <a
                                    href="/penjualan/{{ $item->id }}"
                                    class="detail-button"
                                >
                                    Detail
                                </a>

                                {{-- Status menunggu: tombol Proses --}}
                                @if($item->status === 'menunggu')
                                    <form
                                        action="{{ route('penjualan.updateStatus', $item->id) }}"
                                        method="POST"
                                        class="status-action-form"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            name="status"
                                            value="diproses"
                                            class="status-action-button"
                                        >
                                            Proses
                                        </button>
                                    </form>
                                @endif

                                {{-- Status diproses: tombol Selesaikan --}}
                                @if($item->status === 'diproses')
                                    <form
                                        action="{{ route('penjualan.updateStatus', $item->id) }}"
                                        method="POST"
                                        class="status-action-form"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            name="status"
                                            value="selesai"
                                            class="status-action-button"
                                        >
                                            Selesaikan
                                        </button>
                                    </form>
                                @endif

                                {{-- Batalkan pesanan yang masih aktif --}}
                                @if(in_array($item->status, ['menunggu', 'diproses']))
                                    <form
                                        action="{{ route('penjualan.updateStatus', $item->id) }}"
                                        method="POST"
                                        class="status-action-form"
                                        onsubmit="return confirm('Yakin ingin membatalkan pesanan ini? Stok menu akan dikembalikan.')"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            name="status"
                                            value="dibatalkan"
                                            class="status-action-button cancel-button"
                                        >
                                            Batalkan
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-orders">
                                <div class="empty-icon">🧾</div>

                                <strong>Belum ada pesanan</strong>

                                Data transaksi akan muncul di sini setelah pesanan dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection