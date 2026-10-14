@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')

<div class="page-title">
    <h1>Pembayaran</h1>
    <p>
        Selesaikan pembayaran transaksi
        {{ $penjualan->kode_transaksi }}.
    </p>
</div>

<div class="card">

    <div class="card-header">
        <div>
            <h2>{{ $penjualan->kode_transaksi }}</h2>
            <p>Informasi pembayaran transaksi.</p>
        </div>

        <a
            href="/penjualan/{{ $penjualan->id }}"
            class="btn btn-secondary"
        >
            Kembali
        </a>
    </div>


    {{-- INFORMASI TAGIHAN --}}
    <div style="
        background:#fffaf3;
        padding:25px;
        border-radius:14px;
        margin-bottom:25px;
    ">

        <div style="
            display:flex;
            justify-content:space-between;
            margin-bottom:12px;
        ">
            <span>Pelanggan</span>

            <strong>
                {{ $penjualan->nama_pelanggan ?? 'Umum' }}
            </strong>
        </div>


        <div style="
            display:flex;
            justify-content:space-between;
        ">

            <span>Total Tagihan</span>

            <strong style="
                font-size:24px;
                color:#7b4526;
            ">
                Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}
            </strong>

        </div>

    </div>


    {{-- PESAN ERROR --}}
    @if ($errors->any())

        <div style="
            background:#fff1f1;
            border:1px solid #f0b5b5;
            color:#a33;
            padding:14px 16px;
            border-radius:10px;
            margin-bottom:20px;
        ">

            {{ $errors->first() }}

        </div>

    @endif


    {{-- FORM PEMBAYARAN --}}
    <form
        action="/penjualan/{{ $penjualan->id }}/payment"
        method="POST"
    >

        @csrf


        {{-- METODE PEMBAYARAN --}}
        <div class="form-group">

            <label class="form-label">
                Metode Pembayaran
            </label>

            <select
                name="metode_pembayaran"
                class="form-control"
                required
            >

                <option value="">
                    -- Pilih Metode Pembayaran --
                </option>

                <option value="tunai">
                    💵 Tunai
                </option>

                <option value="transfer">
                    🏦 Transfer
                </option>

                <option value="qris">
                    📱 QRIS
                </option>

            </select>

        </div>


        {{-- JUMLAH BAYAR --}}
        <div class="form-group">

            <label class="form-label">
                Jumlah Bayar
            </label>

            <input
                type="number"
                name="jumlah_bayar"
                class="form-control"
                min="0"
                placeholder="Contoh: 20000"
                required
            >

            <small style="
                display:block;
                margin-top:7px;
                color:#999;
            ">
                Masukkan jumlah uang yang dibayarkan pelanggan.
            </small>

        </div>


        {{-- INFORMASI --}}
        <div style="
            background:#f8f1e8;
            padding:16px;
            border-radius:10px;
            margin-top:20px;
            color:#6d4931;
        ">

            <strong>
                💡 Informasi
            </strong>

            <div style="
                margin-top:5px;
                font-size:13px;
            ">
                Jika pembayaran tunai lebih besar dari total
                tagihan, sistem akan menghitung kembalian
                secara otomatis.
            </div>

        </div>


        {{-- TOMBOL --}}
        <div style="
            display:flex;
            gap:10px;
            margin-top:25px;
        ">

            <button
                type="submit"
                class="btn btn-success"
            >
                💳 Simpan Pembayaran
            </button>

            <a
                href="/penjualan/{{ $penjualan->id }}"
                class="btn btn-secondary"
            >
                Batal
            </a>

        </div>

    </form>

</div>

@endsection