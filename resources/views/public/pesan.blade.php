@extends('layouts.public')

@section('title', 'Pesan Menu - Nasi Ibu')

@section('content')

<section style="background:#fffaf5;padding:45px 20px 60px;">
    <div style="max-width:850px;margin:auto;">

        <a href="{{ url('/menu/' . $menu->id) }}"
           style="display:inline-block;margin-bottom:22px;color:#8d4b2c;text-decoration:none;">
            ← Kembali ke Detail Menu
        </a>

        <div style="margin-bottom:25px;">
            <h1 style="color:#4b3021;font-size:30px;margin-bottom:8px;">
                Form Pemesanan
            </h1>
            <p style="color:#888;font-size:14px;">
                Isi data berikut untuk memesan masakan Nasi Ibu.
            </p>
        </div>

        @if ($errors->any())
            <div style="background:#fff0f0;color:#a33;padding:14px;border-radius:10px;margin-bottom:20px;">
                <ul style="margin:0;padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="background:white;border:1px solid #eee2d9;border-radius:16px;padding:25px;box-shadow:0 8px 25px rgba(75,48,33,.06);">

            <div style="display:flex;gap:18px;align-items:center;margin-bottom:25px;">
                @if($menu->foto)
                    <img
                        src="{{ asset('storage/' . $menu->foto) }}"
                        alt="{{ $menu->nama_menu }}"
                        style="width:115px;height:100px;object-fit:cover;border-radius:12px;"
                    >
                @else
                    <div style="width:115px;height:100px;display:flex;align-items:center;justify-content:center;background:#f5e5d2;border-radius:12px;font-size:38px;">
                        🍱
                    </div>
                @endif

                <div>
                    <span style="color:#8d4b2c;font-size:12px;">
                        {{ $menu->kategori }}
                    </span>

                    <h2 style="color:#4b3021;font-size:21px;margin:5px 0;">
                        {{ $menu->nama_menu }}
                    </h2>

                    <strong style="color:#8d4b2c;font-size:19px;">
                        Rp {{ number_format($menu->harga, 0, ',', '.') }}
                    </strong>

                    <p style="color:#888;font-size:12px;margin-top:5px;">
                        Stok tersedia: {{ $menu->stok }} porsi
                    </p>
                </div>
            </div>

            <form action="{{ route('public.order.store') }}" method="POST">
                @csrf

                <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                <div style="margin-bottom:20px;">
                    <label for="nama_pelanggan" style="display:block;font-weight:600;color:#4b3021;margin-bottom:8px;">
                        Nama Pemesan *
                    </label>
                    <input
                        id="nama_pelanggan"
                        type="text"
                        name="nama_pelanggan"
                        value="{{ old('nama_pelanggan') }}"
                        maxlength="100"
                        required
                        placeholder="Masukkan nama kamu"
                        style="width:100%;box-sizing:border-box;padding:13px;border:1px solid #e2d5ca;border-radius:9px;"
                    >
                </div>

                <div style="margin-bottom:20px;">
    <label for="no_whatsapp"
           style="display:block;font-weight:600;color:#4b3021;margin-bottom:8px;">
        Nomor WhatsApp *
    </label>

    <input
        id="no_whatsapp"
        type="tel"
        name="no_whatsapp"
        value="{{ old('no_whatsapp') }}"
        maxlength="25"
        required
        placeholder="Contoh: 081234567890"
        style="width:100%;box-sizing:border-box;padding:13px;border:1px solid #e2d5ca;border-radius:9px;"
    >
</div>

<div style="margin-bottom:20px;">
    <label for="alamat_pelanggan"
           style="display:block;font-weight:600;color:#4b3021;margin-bottom:8px;">
        Alamat Pengantaran
    </label>

    <textarea
        id="alamat_pelanggan"
        name="alamat_pelanggan"
        rows="3"
        maxlength="1000"
        placeholder="Masukkan alamat jika pesanan ingin diantar (opsional)"
        style="width:100%;box-sizing:border-box;padding:13px;border:1px solid #e2d5ca;border-radius:9px;resize:vertical;"
    >{{ old('alamat_pelanggan') }}</textarea>
</div>

                <div style="margin-bottom:20px;">
                    <label for="jumlah" style="display:block;font-weight:600;color:#4b3021;margin-bottom:8px;">
                        Jumlah Porsi *
                    </label>
                    <input
                        id="jumlah"
                        type="number"
                        name="jumlah"
                        value="{{ old('jumlah', request('jumlah', 1)) }}"
                        min="1"
                        max="{{ $menu->stok }}"
                        required
                        style="width:100%;box-sizing:border-box;padding:13px;border:1px solid #e2d5ca;border-radius:9px;"
                    >
                </div>

                <div style="margin-bottom:22px;">
                    <label for="catatan" style="display:block;font-weight:600;color:#4b3021;margin-bottom:8px;">
                        Catatan Pesanan
                    </label>
                    <textarea
                        id="catatan"
                        name="catatan"
                        rows="3"
                        placeholder="Contoh: sambal dipisah (opsional)"
                        style="width:100%;box-sizing:border-box;padding:13px;border:1px solid #e2d5ca;border-radius:9px;resize:vertical;"
                    >{{ old('catatan') }}</textarea>
                </div>

                <button type="submit" style="width:100%;padding:15px;border:0;border-radius:10px;background:#8d4b2c;color:white;font-size:15px;font-weight:bold;cursor:pointer;">
                    Kirim Pesanan →
                </button>

                <p style="text-align:center;color:#999;font-size:12px;line-height:1.6;margin-top:13px;">
                    Pembayaran akan dikonfirmasi sesuai proses yang ditetapkan oleh Nasi Ibu.
                </p>
            </form>
        </div>
    </div>
</section>

@endsection