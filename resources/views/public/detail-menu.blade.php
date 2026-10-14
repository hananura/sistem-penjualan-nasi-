```blade
@extends('layouts.public')

@section('title', $menu->nama_menu . ' - Nasi Ibu')

@section('content')

<section style="
    background:#fffaf5;
    min-height:70vh;
    padding:45px 20px 60px;
">
    <div style="
        max-width:1000px;
        margin:auto;
    ">

        <a href="/menu" style="
            display:inline-block;
            color:#8d4b2c;
            text-decoration:none;
            margin-bottom:25px;
            font-weight:600;
        ">
            ← Kembali ke Daftar Menu
        </a>

        <div style="
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(min(100%,300px),1fr));
            gap:35px;
            background:#fff;
            border:1px solid #eee2d9;
            border-radius:18px;
            padding:25px;
            box-shadow:0 8px 25px rgba(75,48,33,.07);
        ">

            {{-- FOTO MENU --}}
            <div>
                @if($menu->foto)
                    <img
                        src="{{ asset('storage/' . $menu->foto) }}"
                        alt="{{ $menu->nama_menu }}"
                        style="
                            width:100%;
                            height:340px;
                            object-fit:cover;
                            border-radius:14px;
                        "
                    >
                @else
                    <div style="
                        height:340px;
                        background:#f5e6d7;
                        border-radius:14px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:90px;
                    ">
                        🍚
                    </div>
                @endif
            </div>

            {{-- INFORMASI MENU --}}
            <div style="
                display:flex;
                flex-direction:column;
                justify-content:center;
                padding:5px;
            ">

                <span style="
                    display:inline-block;
                    width:fit-content;
                    background:#f8eadc;
                    color:#8d4b2c;
                    padding:7px 13px;
                    border-radius:20px;
                    font-size:12px;
                    margin-bottom:15px;
                ">
                    {{ $menu->kategori }}
                </span>

                <h1 style="
                    color:#4b3021;
                    font-size:30px;
                    margin:0 0 15px;
                ">
                    {{ $menu->nama_menu }}
                </h1>

                <p style="
                    color:#777;
                    font-size:14px;
                    line-height:1.8;
                    margin-bottom:20px;
                ">
                    {{ $menu->deskripsi ?: 'Masakan rumahan yang dibuat dengan penuh kasih.' }}
                </p>

                <div style="
                    color:#8d4b2c;
                    font-size:28px;
                    font-weight:700;
                    margin-bottom:18px;
                ">
                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                </div>

                <p style="
                    color:#666;
                    font-size:14px;
                    margin-bottom:25px;
                ">
                    Stok tersedia: <strong>{{ $menu->stok }}</strong>
                </p>

                @if($menu->status === 'tersedia' && $menu->stok > 0)
                    <a href="/menu/{{ $menu->id }}/pesan" style="
                        display:inline-block;
                        text-align:center;
                        background:#95502f;
                        color:#fff;
                        text-decoration:none;
                        padding:14px 20px;
                        border-radius:10px;
                        font-weight:600;
                    ">
                        🛒 Pesan Menu Ini
                    </a>
                @else
                    <span style="
                        display:inline-block;
                        text-align:center;
                        background:#eee;
                        color:#777;
                        padding:14px 20px;
                        border-radius:10px;
                    ">
                        Menu Sedang Habis
                    </span>
                @endif

            </div>
        </div>
    </div>
</section>

@endsection
```