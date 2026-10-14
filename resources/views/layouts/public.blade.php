<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Nasi Ibu')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 90px;
        }

        body {
            font-family: Arial, sans-serif;
            background: #fffaf5;
            color: #3c2920;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
        }

        .container {
            width: min(1180px, 92%);
            margin: auto;
        }

        /* =========================
           HEADER
        ========================= */

        .public-header {
            min-height: 72px;
            background: white;
            border-bottom: 1px solid #eee2d8;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f0d3a9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .logo-text strong {
            display: block;
            font-size: 17px;
            color: #7d4025;
        }

        .logo-text span {
            display: block;
            font-size: 9px;
            color: #8d8179;
            margin-top: 2px;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 27px;
            font-size: 13px;
            color: #5d514a;
        }

        .nav a {
            transition: color .2s;
        }

        .nav a:hover {
            color: #9b5735;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .header-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c5142;
        }

        .header-icon:hover {
            background: #faf0e7;
        }

        .login-btn {
            background: #934f2d;
            color: white;
            padding: 10px 18px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: bold;
        }

        .login-btn:hover {
            background: #773c21;
        }

        /* Jarak agar tujuan navigasi tidak tertutup header */
        #tentang,
        #kontak {
            scroll-margin-top: 90px;
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            background:
                linear-gradient(
                    90deg,
                    rgba(92, 43, 20, .93) 0%,
                    rgba(126, 62, 29, .80) 48%,
                    rgba(126, 62, 29, .25) 100%
                );
            min-height: 360px;
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(
                    circle at 80% 50%,
                    rgba(255,255,255,.12),
                    transparent 35%
                );
            pointer-events: none;
        }

        .hero-inner {
            min-height: 360px;
            display: flex;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            width: 52%;
            color: white;
        }

        .hero-content h1 {
            font-size: 42px;
            line-height: 1.12;
            margin-bottom: 15px;
        }

        .hero-content p {
            font-size: 14px;
            line-height: 1.7;
            color: #f8e9dd;
            max-width: 440px;
            margin-bottom: 25px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .hero-btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: bold;
        }

        .hero-btn-primary {
            background: #713a21;
            color: white;
            border: 1px solid rgba(255,255,255,.25);
        }

        .hero-btn-primary:hover {
            background: #572b19;
        }

        .hero-btn-light {
            background: white;
            color: #744027;
        }

        .hero-btn-light:hover {
            background: #f7eadf;
        }

        .hero-food {
            position: absolute;
            right: -20px;
            bottom: -40px;
            width: 50%;
            height: 330px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-food-card {
            width: 390px;
            height: 270px;
            border-radius: 24px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.22);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-food-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-placeholder {
            font-size: 100px;
        }

        /* =========================
           FEATURES
        ========================= */

        .features {
            background: white;
            border-bottom: 1px solid #eee5df;
        }

        .feature-list {
            min-height: 90px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            align-items: center;
        }

        .feature {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border-right: 1px solid #eee5df;
        }

        .feature:last-child {
            border-right: none;
        }

        .feature-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #fff2e6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feature strong {
            display: block;
            font-size: 11px;
            margin-bottom: 3px;
        }

        .feature span {
            font-size: 9px;
            color: #999;
        }

        /* =========================
           MENU FAVORIT
        ========================= */

        .section {
            padding: 50px 0;
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
        }

        .section-heading h2 {
            font-size: 22px;
            color: #30231d;
        }

        .section-heading p {
            color: #999;
            font-size: 12px;
            margin-top: 5px;
        }

        .see-all {
            color: #8f4b2d;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .see-all:hover {
            color: #63391f;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }

        .menu-card {
            background: white;
            border: 1px solid #eee2d9;
            border-radius: 10px;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(76, 43, 26, .10);
        }

        .menu-photo {
            height: 165px;
            background: #f3e3d4;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .menu-placeholder {
            font-size: 60px;
        }

        .menu-body {
            padding: 13px;
        }

        .menu-body h3 {
            font-size: 13px;
            margin-bottom: 5px;
        }

        .menu-category {
            font-size: 10px;
            color: #999;
            margin-bottom: 9px;
        }

        .menu-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .menu-price {
            font-size: 12px;
            font-weight: bold;
            color: #784126;
        }

        .order-btn {
            background: #914d2d;
            color: white;
            border-radius: 5px;
            padding: 8px 14px;
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .order-btn:hover {
            background: #773c21;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #2d211b;
            color: white;
            padding: 30px 0;
            margin-top: 20px;
        }

        .footer-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .footer-brand strong {
            font-size: 15px;
        }

        .footer-brand p {
            color: #bdb2ab;
            font-size: 10px;
            margin-top: 5px;
        }

        .footer-copy {
            color: #a99f99;
            font-size: 10px;
        }

        /* =========================
           RESPONSIVE TABLET
        ========================= */

        @media (max-width: 900px) {
            .header-inner {
                gap: 15px;
            }

            .nav {
                gap: 14px;
            }

            .hero-content {
                width: 58%;
            }

            .hero-content h1 {
                font-size: 34px;
            }

            .hero-food {
                width: 45%;
            }

            .menu-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        /* =========================
           RESPONSIVE HP
        ========================= */

        @media (max-width: 650px) {
            .public-header {
                padding: 12px 0;
            }

            .header-inner {
                flex-wrap: wrap;
                gap: 12px;
            }

            .nav {
                order: 3;
                width: 100%;
                justify-content: center;
                gap: 18px;
                flex-wrap: wrap;
                font-size: 12px;
            }

            .header-actions {
                margin-left: auto;
            }

            .hero,
            .hero-inner {
                min-height: 500px;
            }

            .hero-content {
                width: 100%;
                padding-top: 30px;
                align-self: flex-start;
            }

            .hero-content h1 {
                font-size: 32px;
            }

            .hero-content p {
                font-size: 13px;
            }

            .hero-food {
                width: 100%;
                height: 210px;
                right: 0;
                bottom: -15px;
            }

            .hero-food-card {
                width: 80%;
                height: 180px;
            }

            .feature-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                padding: 12px 0;
            }

            .feature {
                padding: 10px 5px;
                border-right: none;
                justify-content: flex-start;
            }

            .feature strong {
                font-size: 10px;
            }

            .feature span {
                font-size: 9px;
            }

            .menu-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }

            .menu-photo {
                height: 130px;
            }

            .menu-body {
                padding: 10px;
            }

            .menu-body h3 {
                font-size: 12px;
            }

            .menu-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .order-btn {
                text-align: center;
                width: 100%;
            }

            .section {
                padding: 35px 0;
            }

            .section-heading h2 {
                font-size: 19px;
            }

            .section-heading p {
                font-size: 11px;
            }

            .footer-inner {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<header class="public-header">
    <div class="container header-inner">

        {{-- Logo kembali ke Beranda --}}
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-icon">🍚</div>

            <div class="logo-text">
                <strong>Nasi Ibu</strong>
                <span>Masakan Rumahan, Penuh Kasih</span>
            </div>
        </a>

        {{-- Navigasi publik --}}
        <nav class="nav" aria-label="Navigasi utama">

            <a href="{{ route('home') }}">
                Beranda
            </a>

            <a href="{{ route('public.menu') }}">
                Menu
            </a>

            {{-- Tetap berfungsi dari halaman mana pun --}}
            <a href="{{ route('home') }}#tentang">
                Tentang
            </a>

            <a href="{{ route('home') }}#kontak">
                Kontak
            </a>

        </nav>

        <div class="header-actions">
            <a href="{{ route('login') }}"
               class="header-icon"
               aria-label="Login admin">
                👤
            </a>

            <a href="{{ route('login') }}" class="login-btn">
                Login
            </a>
        </div>

    </div>
</header>

{{-- Isi halaman Beranda, Menu, Detail Menu, dan halaman publik lain --}}
<main>
    @yield('content')
</main>

<footer>
    <div class="container footer-inner">

        <div class="footer-brand">
            <strong>🍚 Nasi Ibu</strong>

            <p>
                Masakan rumahan, penuh kasih.
            </p>
        </div>

        <div class="footer-copy">
            © {{ date('Y') }} Nasi Ibu
        </div>

    </div>
</footer>

</body>
</html>