@extends('layouts.public')

@section('title', 'Daftar Menu - Nasi Ibu')

@section('content')

{{-- BANNER MENU --}}
<section style="
    background:linear-gradient(90deg,rgba(69,35,19,.90),rgba(69,35,19,.35)),
    linear-gradient(135deg,#b97745,#63351f);
    color:white;
    padding:45px 0;
    text-align:center;
">
    <div class="container">
        <h1 style="font-size:32px;margin-bottom:10px;">
            Daftar Menu
        </h1>

        <p style="font-size:14px;color:#fff0e3;">
            Pilih menu favoritmu dan nikmati kelezatannya!
        </p>
    </div>
</section>

{{-- DAFTAR MENU --}}
<section class="section">
    <div class="container">

        {{-- FILTER KATEGORI --}}
        <div style="
            display:flex;
            justify-content:center;
            flex-wrap:wrap;
            gap:10px;
            margin-bottom:30px;
        ">
            <a
                href="{{ route('public.menu') }}"
                style="
                    padding:10px 20px;
                    border-radius:8px;
                    background:{{ !$kategori || $kategori === 'Semua' ? '#914d2d' : '#fff' }};
                    color:{{ !$kategori || $kategori === 'Semua' ? '#fff' : '#654431' }};
                    border:1px solid #ead9cc;
                    font-size:13px;
                "
            >
                Semua
            </a>

            @foreach($kategoriMenu as $itemKategori)
                <a
                    href="{{ route('public.menu', ['kategori' => $itemKategori]) }}"
                    style="
                        padding:10px 20px;
                        border-radius:8px;
                        background:{{ $kategori === $itemKategori ? '#914d2d' : '#fff' }};
                        color:{{ $kategori === $itemKategori ? '#fff' : '#654431' }};
                        border:1px solid #ead9cc;
                        font-size:13px;
                    "
                >
                    {{ $itemKategori }}
                </a>
            @endforeach
        </div>

        {{-- JUDUL --}}
        <div class="section-heading">
            <div>
                <h2>
                    {{ $kategori && $kategori !== 'Semua' ? $kategori : 'Semua Menu' }}
                </h2>

                <p>
                    {{ $menus->count() }} menu tersedia
                </p>
            </div>
        </div>

        {{-- KARTU MENU --}}
        <div class="menu-grid">
            @forelse($menus as $menu)
                <article class="menu-card">

                    <div class="menu-photo">
                        @if($menu->foto)
                            <img
                                src="{{ asset('storage/' . $menu->foto) }}"
                                alt="{{ $menu->nama_menu }}"
                                loading="lazy"
                            >
                        @else
                            <div class="menu-placeholder">🍚</div>
                        @endif
                    </div>

                    <div class="menu-body">
                        <h3>{{ $menu->nama_menu }}</h3>

                        <div class="menu-category">
                            {{ $menu->kategori }}
                        </div>

                        @if($menu->deskripsi)
                            <p style="
                                color:#888;
                                font-size:11px;
                                line-height:1.6;
                                margin-bottom:12px;
                            ">
                                {{ $menu->deskripsi }}
                            </p>
                        @endif

                        <div class="menu-footer">
                            <span class="menu-price">
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </span>

                           <a
    href="{{ route('public.menu.detail', $menu->id) }}"
    class="order-btn"
>
    + Pesan
</a>
                        </div>
                    </div>

                </article>
            @empty
                <div style="
                    grid-column:1/-1;
                    text-align:center;
                    padding:45px 20px;
                    color:#999;
                    background:white;
                    border:1px solid #eee2d9;
                    border-radius:12px;
                ">
                    <div style="font-size:50px;margin-bottom:12px;">
                        🍚
                    </div>

                    <strong style="color:#60412f;">
                        Menu belum tersedia
                    </strong>

                    <p style="margin-top:8px;font-size:12px;">
                        Coba pilih kategori lain atau tambahkan menu melalui admin.
                    </p>
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection