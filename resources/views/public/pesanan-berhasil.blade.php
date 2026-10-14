 @extends('layouts.public')

@section('title', 'Pesanan Berhasil - Nasi Ibu')

@section('content')
<style>
    .success-page {
        background: #fffaf5;
        padding: 48px 20px 70px;
        min-height: 70vh;
    }

    .success-card {
        max-width: 760px;
        margin: 0 auto;
        background: #fff;
        border: 1px solid #f0e1d5;
        border-radius: 24px;
        padding: 38px;
        box-shadow: 0 12px 35px rgba(99, 57, 31, 0.07);
    }

    .success-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .success-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e5f7eb;
        border-radius: 50%;
        font-size: 38px;
    }

    .success-header h1 {
        color: #63391f;
        font-size: clamp(25px, 4vw, 34px);
        line-height: 1.3;
        margin: 0 0 12px;
    }

    .success-header p {
        color: #777;
        font-size: 15px;
        line-height: 1.8;
        max-width: 480px;
        margin: 0 auto;
    }

    .order-box {
        background: #fff8f0;
        border: 1px solid #f2e4d6;
        border-radius: 18px;
        padding: 26px;
    }

    .order-label {
        color: #806d60;
        font-size: 13px;
        margin: 0 0 7px;
    }

    .order-code {
        color: #96502d;
        font-size: clamp(20px, 4vw, 27px);
        line-height: 1.4;
        overflow-wrap: anywhere;
        margin: 0 0 24px;
    }

    .customer-info {
        background: #fff;
        border-radius: 12px;
        padding: 15px 17px;
        margin-bottom: 25px;
        color: #574438;
    }

    .customer-info p {
        margin: 0;
        line-height: 1.7;
    }

    .detail-title {
        color: #63391f;
        font-size: 18px;
        margin: 0 0 15px;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        padding: 14px 0;
        border-bottom: 1px solid #eee1d6;
    }

    .item-name {
        color: #49382e;
        font-weight: 600;
        line-height: 1.5;
    }

    .item-quantity {
        display: block;
        color: #89796e;
        font-size: 13px;
        font-weight: 400;
        margin-top: 4px;
    }

    .item-price {
        color: #49382e;
        white-space: nowrap;
        font-weight: 600;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 20px 0;
        color: #63391f;
        font-size: 16px;
        font-weight: 700;
    }

    .total-price {
        color: #96502d;
        text-align: right;
    }

    .status-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        border-top: 1px solid #eee1d6;
        padding-top: 18px;
    }

    .status-label {
        color: #574438;
        font-weight: 600;
    }

    .status-badge {
        display: inline-block;
        background: #fff0c9;
        color: #8a5a00;
        padding: 7px 13px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
    }

    .success-actions {
        text-align: center;
        margin-top: 28px;
    }

    .back-button {
        display: inline-block;
        background: #96502d;
        color: #fff !important;
        text-decoration: none !important;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        transition: background .2s, transform .2s;
    }

    .back-button:hover {
        background: #783d21;
        transform: translateY(-2px);
    }

    @media (max-width: 600px) {
        .success-page {
            padding: 25px 12px 40px;
        }

        .success-card {
            padding: 23px 16px;
            border-radius: 18px;
        }

        .order-box {
            padding: 19px 15px;
        }

        .success-icon {
            width: 65px;
            height: 65px;
            font-size: 32px;
        }

        .order-item {
            gap: 10px;
        }

        .item-price {
            font-size: 13px;
        }

        .back-button {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>

<section class="success-page">
    <div class="success-card">

        <div class="success-header">
            <div class="success-icon">✓</div>
            <h1>Pesanan Berhasil Dikirim!</h1>
            <p>
                Terima kasih sudah memesan di Nasi Ibu.
                Pesananmu sedang menunggu konfirmasi dari pengelola.
            </p>
        </div>

        <div class="order-box">
            <p class="order-label">KODE PESANAN</p>
            <h2 class="order-code">
                {{ $penjualan->kode_transaksi }}
            </h2>

            <div class="customer-info">
                <p>
                    Nama pelanggan<br>
                    <strong>{{ $penjualan->nama_pelanggan }}</strong>
                </p>
            </div>

            <h3 class="detail-title">Detail Pesanan</h3>

            @foreach ($penjualan->detailPenjualan as $detail)
                <div class="order-item">
                    <div>
                        <div class="item-name">
                            {{ $detail->menu->nama_menu ?? 'Menu' }}
                        </div>
                        <span class="item-quantity">
                            {{ $detail->jumlah }} porsi
                        </span>
                    </div>

                    <div class="item-price">
                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                    </div>
                </div>
            @endforeach

            <div class="order-total">
                <span>Total Pembayaran</span>
                <span class="total-price">
                    Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}
                </span>
            </div>

            <div class="status-row">
                <span class="status-label">Status Pesanan</span>
                <span class="status-badge">
                    {{ ucfirst($penjualan->status) }}
                </span>
            </div>
        </div>

        <div class="success-actions">
            <a href="{{ route('public.menu') }}" class="back-button">
                ← Kembali ke Menu
            </a>
        </div>

    </div>
</section>
@endsection