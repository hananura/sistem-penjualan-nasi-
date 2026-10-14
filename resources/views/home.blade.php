@extends('layouts.public')

@section('title', 'Nasi Ibu - Masakan Rumahan')

@section('content')

{{-- =========================================
     HERO / HALAMAN UTAMA
========================================= --}}
<section class="hero">
    <div class="container hero-inner">

        <div class="hero-content">
            <h1>
                Masakan Rumahan<br>
                dengan Rasa yang<br>
                Bikin Kangen
            </h1>

            <p>
                Nikmati masakan hangat seperti di rumah sendiri.
                Dibuat dengan bahan pilihan dan penuh kasih
                untuk menemani setiap hari.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('public.menu') }}"
                   class="hero-btn hero-btn-primary">
                    Lihat Menu
                </a>

                <a href="{{ route('public.menu') }}"
                   class="hero-btn hero-btn-light">
                    Pesan Sekarang
                </a>
            </div>
        </div>

        <div class="hero-food">
            <div class="hero-food-card">
                @if($menuFavorit->first()?->foto)
                    <img
                        src="{{ asset('storage/' . $menuFavorit->first()->foto) }}"
                        alt="{{ $menuFavorit->first()->nama_menu }}"
                    >
                @else
                    <div class="hero-placeholder">🍱</div>
                @endif
            </div>
        </div>

    </div>
</section>


{{-- =========================================
     KEUNGGULAN NASI IBU
========================================= --}}
<section class="features">
    <div class="container feature-list">

        <div class="feature">
            <div class="feature-icon">🔥</div>
            <div>
                <strong>Rasa Lezat</strong>
                <span>Bumbu Pilihan</span>
            </div>
        </div>

        <div class="feature">
            <div class="feature-icon">❤️</div>
            <div>
                <strong>Harga Terjangkau</strong>
                <span>Untuk Semua</span>
            </div>
        </div>

        <div class="feature">
            <div class="feature-icon">💬</div>
            <div>
                <strong>Pesan Mudah</strong>
                <span>Lewat Website</span>
            </div>
        </div>

        <div class="feature">
            <div class="feature-icon">🕐</div>
            <div>
                <strong>Buka Setiap Hari</strong>
                <span>06.00 - 14.00</span>
            </div>
        </div>

    </div>
</section>


{{-- =========================================
     MENU FAVORIT
========================================= --}}
<section class="section">
    <div class="container">

        <div class="section-heading">
            <div>
                <h2>Menu Favorit Hari Ini</h2>
                <p>
                    Pilihan makanan yang siap menemani harimu.
                </p>
            </div>

            <a href="{{ route('public.menu') }}" class="see-all">
                Lihat Semua →
            </a>
        </div>

        <div class="menu-grid">

            @forelse($menuFavorit as $menu)

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

                        <div class="menu-footer">

                            <span class="menu-price">
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </span>

                            {{-- Menu yang dipilih langsung dibuka detailnya --}}
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
                    background:#fff;
                    border:1px solid #eee2d9;
                    border-radius:12px;
                ">
                    <div style="font-size:50px;margin-bottom:12px;">
                        🍚
                    </div>

                    <strong style="color:#60412f;">
                        Belum ada menu tersedia
                    </strong>

                    <p style="margin-top:8px;font-size:12px;">
                        Menu akan ditampilkan ketika tersedia.
                    </p>

                    <a
                        href="{{ route('public.menu') }}"
                        class="hero-btn hero-btn-primary"
                        style="display:inline-block;margin-top:12px;"
                    >
                        Lihat Menu
                    </a>
                </div>

            @endforelse

        </div>
    </div>
</section>


{{-- =========================================
     TENTANG NASI IBU
========================================= --}}
<section
    id="tentang"
    style="
        background:#fff;
        padding:55px 0;
        border-top:1px solid #eee5df;
    "
>
    <div class="container">

        <div style="
            max-width:700px;
            margin:auto;
            text-align:center;
        ">

            <div style="font-size:40px;margin-bottom:12px;">
                🍚
            </div>

            <h2 style="
                font-size:24px;
                margin-bottom:10px;
                color:#4b3021;
            ">
                Tentang Nasi Ibu
            </h2>

            <p style="
                color:#888;
                font-size:13px;
                line-height:1.8;
            ">
                {{ $pengaturan?->deskripsi ?? 'Masakan rumahan, penuh kasih.' }}
            </p>

        </div>

    </div>
</section>


{{-- =========================================
     KONTAK NASI IBU
========================================= --}}
<section
    id="kontak"
    style="
        padding:45px 0;
        background:#fffaf5;
    "
>
    <div class="container">

        <div style="
            text-align:center;
            max-width:600px;
            margin:auto;
        ">

            <h2 style="
                font-size:22px;
                margin-bottom:10px;
                color:#4b3021;
            ">
                Hubungi Kami
            </h2>

            <p style="
                color:#888;
                font-size:12px;
                line-height:1.7;
            ">
                {{ $pengaturan?->alamat ?: 'Alamat usaha belum diatur.' }}
            </p>

            @if($pengaturan?->no_hp)

                <p style="
                    margin-top:12px;
                    color:#8d4b2c;
                    font-weight:bold;
                    font-size:13px;
                ">
                    📱 {{ $pengaturan->no_hp }}
                </p>

            @endif

        </div>

    </div>
</section>

@endsection