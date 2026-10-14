
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin - Nasi Ibu')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f6f6f6;
            color: #333;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 230px;
            height: 100vh;
            overflow-y: auto;
            background: #18212b;
            color: white;
            padding: 22px 15px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px 25px;
            border-bottom: 1px solid #34404c;
            margin-bottom: 20px;
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            background: #d6a15d;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .brand-text strong {
            display: block;
            font-size: 16px;
        }

        .brand-text span {
            font-size: 9px;
            color: #c9c9c9;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 6px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            color: #d5d9dd;
            text-decoration: none;
            border-radius: 7px;
            font-size: 14px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #a95f38;
            color: white;
        }

        .sidebar-menu .icon {
            width: 20px;
            text-align: center;
        }

        .logout-button {
            width: 100%;
            border: none;
            background: transparent;
            color: #d5d9dd;
            padding: 12px 14px;
            text-align: left;
            cursor: pointer;
            font-size: 14px;
            font-family: inherit;
            border-radius: 7px;
        }

        .logout-button:hover {
            background: #a95f38;
            color: white;
        }

        /* ================= MAIN ================= */

        .main {
            margin-left: 230px;
            min-height: 100vh;
        }

        .topbar {
            min-height: 65px;
            background: white;
            border-bottom: 1px solid #e5e5e5;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 12px 30px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .admin-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ================= CONTENT ================= */

        .content {
            padding: 30px;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            font-size: 25px;
            color: #333;
            margin-bottom: 5px;
        }

        .page-title p {
            color: #888;
            font-size: 13px;
        }

        /* ================= STATISTIK ================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #e8e8e8;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .stat-info span {
            display: block;
            font-size: 12px;
            color: #888;
            margin-bottom: 8px;
        }

        .stat-info strong {
            font-size: 23px;
            color: #333;
            overflow-wrap: anywhere;
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f7e6d8;
            font-size: 20px;
            flex-shrink: 0;
        }

        /* ================= CARD ================= */

        .card {
            background: white;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
            padding: 22px;
            margin-bottom: 20px;
            min-width: 0;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 18px;
        }

        .card-header h2 {
            font-size: 17px;
        }

        .card-header p {
            font-size: 12px;
            color: #999;
            margin-top: 4px;
        }

        /* ================= BUTTON ================= */

        .btn {
            display: inline-block;
            padding: 9px 15px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 12px;
            white-space: nowrap;
        }

        .btn-primary {
            background: #9b5735;
            color: white;
        }

        .btn-primary:hover {
            background: #81452a;
        }

        .btn-success {
            background: #58a56b;
            color: white;
        }

        .btn-danger {
            background: #dc5b5b;
            color: white;
        }

        .btn-warning {
            background: #d69a3a;
            color: white;
        }

        .btn-secondary {
            background: #777;
            color: white;
        }

        /* ================= TABLE SERAGAM ================= */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #f0e2d7;
            border-radius: 12px;
            background: #fff;
        }

        .table-wrapper table,
        .card > table,
        .card .table-container table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 0;
            background: #fff;
        }

        .table-wrapper table thead th,
        .card > table thead th,
        .card .table-container table thead th {
            background: #f8eee5;
            color: #70401f;
            font-size: 12px;
            font-weight: 600;
            padding: 16px;
            text-align: left;
            white-space: nowrap;
            border-bottom: 1px solid #f0e2d7;
        }

        .table-wrapper table tbody td,
        .card > table tbody td,
        .card .table-container table tbody td {
            background: #fff;
            color: #333;
            font-size: 13px;
            padding: 16px;
            border-bottom: 1px solid #f0e2d7;
            vertical-align: middle;
        }

        .table-wrapper table tbody tr:last-child td,
        .card > table tbody tr:last-child td,
        .card .table-container table tbody tr:last-child td {
            border-bottom: none;
        }

        .table-wrapper table tbody tr:hover td,
        .card > table tbody tr:hover td,
        .card .table-container table tbody tr:hover td {
            background: #fffaf6;
        }

        /* Untuk tabel yang memakai kelas table saja */

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
        }

        .table thead th {
            background: #f8eee5;
            color: #70401f;
            font-size: 12px;
            font-weight: 600;
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #f0e2d7;
        }

        .table tbody td {
            background: #fff;
            color: #333;
            font-size: 13px;
            padding: 16px;
            border-bottom: 1px solid #f0e2d7;
            vertical-align: middle;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover td {
            background: #fffaf6;
        }

        /* ================= STATUS ================= */

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status-success {
            background: #dff4e4;
            color: #31804a;
        }

        .status-warning {
            background: #fff0c9;
            color: #9a711b;
        }

        .status-danger {
            background: #ffe0e0;
            color: #b84040;
        }

        .status-info {
            background: #dcecff;
            color: #3972b5;
        }

        /* ================= MENU CARD ================= */

        .menu-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .menu-item {
            border: 1px solid #eee;
            border-radius: 7px;
            padding: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .menu-item-info strong {
            display: block;
            font-size: 13px;
        }

        .menu-item-info span {
            font-size: 11px;
            color: #999;
        }

        /* ================= ALERT ================= */

        .alert {
            padding: 13px 16px;
            background: #e1f3e5;
            color: #3c7548;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* ================= FORM ================= */

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #3f3027;
        }

        .form-control {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 12px 14px;
            border: 1px solid #ddd0c4;
            border-radius: 9px;
            background: #fff;
            color: #333;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #b56638;
            box-shadow: 0 0 0 3px rgba(181, 102, 56, 0.12);
        }

        textarea.form-control {
            min-height: 110px;
            resize: vertical;
        }

        select.form-control {
            cursor: pointer;
        }

        input[type="file"].form-control {
            padding: 9px;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 1100px) {
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 190px;
            }

            .main {
                margin-left: 190px;
            }

            .content {
                padding: 22px;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                justify-content: center;
            }

            .content {
                padding: 18px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .menu-list {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 16px;
            }

            .card-header {
                flex-wrap: wrap;
            }

            .table-wrapper table {
                min-width: 600px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="brand">
            <div class="brand-icon">🍚</div>

            <div class="brand-text">
                <strong>Nasi Ibu</strong>
                <span>Masakan Rumahan, Penuh Kasih</span>
            </div>
        </div>

        <nav class="sidebar-menu">

            <ul style="list-style: none;">

                <li>
                    <a href="/dashboard">
                        <span class="icon">🏠</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/menu">
                        <span class="icon">🍚</span>
                        <span>Menu</span>
                    </a>
                </li>

                <li>
                    <a href="/penjualan">
                        <span class="icon">🧾</span>
                        <span>Pesanan</span>
                    </a>
                </li>

                <li>
                    <a href="/pelanggan">
                        <span class="icon">👥</span>
                        <span>Pelanggan</span>
                    </a>
                </li>

                <li>
                    <a href="/laporan">
                        <span class="icon">📊</span>
                        <span>Laporan</span>
                    </a>
                </li>

                <li>
                    <a href="/pengaturan">
                        <span class="icon">⚙️</span>
                        <span>Pengaturan</span>
                    </a>
                </li>

                <li>
                    <form action="/logout" method="POST">
                        @csrf

                        <button type="submit" class="logout-button">
                            🚪 &nbsp; Logout
                        </button>
                    </form>
                </li>

            </ul>

        </nav>

    </aside>

    <!-- MAIN -->

    <div class="main">

        <!-- TOPBAR -->

        <header class="topbar">

            <div class="admin-profile">

                <div class="admin-avatar">👤</div>

                <span>
                    {{ auth()->user()->nama ?? 'Admin' }}
                </span>

            </div>

        </header>

        <!-- CONTENT -->

        <main class="content">

            @if(session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</body>
</html>
