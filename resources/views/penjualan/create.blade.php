@extends('layouts.app')

@section('title', 'Buat Pesanan')

@section('content')

<div class="page-title">
    <h1>Buat Pesanan</h1>
    <p>Buat transaksi penjualan baru.</p>
</div>

<div class="card">

    <div class="card-header">
        <div>
            <h2>Informasi Pesanan</h2>
            <p>Masukkan data pelanggan dan pilih menu yang dipesan.</p>
        </div>

        <a href="/penjualan" class="btn btn-secondary">
            Kembali
        </a>
    </div>

   <form action="/penjualan" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">Nama Pelanggan</label>

            <input
                type="text"
                name="nama_pelanggan"
                class="form-control"
                placeholder="Contoh: Ibu Siti"
            >
        </div>

        <div class="form-group">
            <label class="form-label">Pilih Menu</label>

            <select name="menu_id" class="form-control">
                <option value="">-- Pilih Menu --</option>

                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">
                        {{ $menu->nama_menu }}
                        - Rp {{ number_format($menu->harga, 0, ',', '.') }}
                        (Stok: {{ $menu->stok }})
                    </option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Jumlah</label>

            <input
                type="number"
                name="jumlah"
                class="form-control"
                value="1"
                min="1"
            >
        </div>

        <div class="form-group">
            <label class="form-label">Catatan</label>

            <textarea
                name="catatan"
                class="form-control"
                rows="4"
                placeholder="Contoh: Sambalnya dipisah."
            ></textarea>
        </div>

        <div style="display:flex;gap:10px;margin-top:25px;">

            <button type="submit" class="btn btn-primary">
                Simpan Pesanan
            </button>

            <a href="/penjualan" class="btn btn-secondary">
                Batal
            </a>

        </div>

    </form>

</div>

@endsection