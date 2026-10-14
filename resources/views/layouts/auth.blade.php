<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Login - Nasi Ibu')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,.35), transparent 30%),
                linear-gradient(135deg, #6f3f22 0%, #a9602e 48%, #d8944d 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
            color: #3f2a1e;
        }

        .login-wrapper {
            width: 100%;
            max-width: 950px;
            min-height: 560px;
            background: #fffaf3;
            border-radius: 28px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 25px 70px rgba(50, 25, 10, .28);
        }

        /* BAGIAN KIRI */
        .login-left {
            background:
                linear-gradient(rgba(91, 49, 25, .78), rgba(91, 49, 25, .78)),
                linear-gradient(135deg, #8b522e, #c17a3d);
            color: white;
            padding: 55px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .login-left::before {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border: 35px solid rgba(255,255,255,.08);
            border-radius: 50%;
            top: -80px;
            right: -80px;
        }

        .login-left::after {
            content: "";
            position: absolute;
            width: 160px;
            height: 160px;
            border: 25px solid rgba(255,255,255,.06);
            border-radius: 50%;
            bottom: -70px;
            left: -60px;
        }

        .brand-icon {
            width: 75px;
            height: 75px;
            background: rgba(255,255,255,.16);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }

        .login-left h1 {
            font-size: 38px;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .login-left p {
            font-size: 15px;
            line-height: 1.8;
            color: rgba(255,255,255,.82);
            max-width: 350px;
            position: relative;
            z-index: 1;
        }

        .feature-list {
            list-style: none;
            margin-top: 35px;
            position: relative;
            z-index: 1;
        }

        .feature-list li {
            margin-bottom: 15px;
            font-size: 14px;
            color: rgba(255,255,255,.9);
        }

        .feature-list span {
            display: inline-flex;
            width: 28px;
            height: 28px;
            background: rgba(255,255,255,.13);
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
        }

        /* BAGIAN KANAN */
        .login-right {
            padding: 55px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fffdf9;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-size: 29px;
            color: #3f2a1e;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #927d6d;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #5a4030;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #e5d7c9;
            border-radius: 12px;
            background: #fff;
            color: #3f2a1e;
            font-size: 14px;
            outline: none;
            transition: .2s;
        }

        .form-control:focus {
            border-color: #a9602e;
            box-shadow: 0 0 0 4px rgba(169, 96, 46, .10);
        }

        .login-btn {
            width: 100%;
            border: none;
            padding: 15px;
            border-radius: 12px;
            background: linear-gradient(135deg, #7b4526, #b86d35);
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 5px;
            box-shadow: 0 8px 20px rgba(123, 69, 38, .20);
            transition: .2s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(123, 69, 38, .27);
        }

        .error {
            background: #fff0ee;
            color: #b84235;
            border: 1px solid #f3c8c3;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            color: #aa9788;
            font-size: 12px;
        }

        @media (max-width: 750px) {
            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .login-left {
                padding: 35px;
                min-height: 270px;
            }

            .login-left h1 {
                font-size: 30px;
            }

            .feature-list {
                display: none;
            }

            .login-right {
                padding: 35px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <div class="login-left">

            <div class="brand-icon">
                🍚
            </div>

            <h1>Nasi Ibu</h1>

            <p>
                Sistem informasi penjualan untuk membantu
                mengelola menu, pesanan, transaksi, dan laporan
                usaha nasi rumahan.
            </p>

            <ul class="feature-list">
                <li>
                    <span>🍱</span>
                    Kelola menu makanan
                </li>

                <li>
                    <span>🧾</span>
                    Kelola pesanan dan transaksi
                </li>

                <li>
                    <span>📊</span>
                    Pantau penjualan dengan mudah
                </li>
            </ul>

        </div>

        <div class="login-right">

            @yield('content')

            <div class="login-footer">
                © {{ date('Y') }} Nasi Ibu · Sistem Informasi Penjualan
            </div>

        </div>

    </div>

</body>
</html>