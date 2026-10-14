@extends('layouts.app')

@section('title', 'Tambah Menu')

@section('content')

<style>
    .menu-form-page {
        max-width: 900px;
        margin: 0 auto;
    }

    .menu-form-page .page-title {
        margin-bottom: 24px;
    }

    .menu-form-page .page-title h1 {
        color: #63391f;
        margin-bottom: 8px;
    }

    .menu-form-card {
        background: #fff;
        border: 1px solid #f0e4da;
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 6px 24px rgba(80, 48, 27, .05);
    }

    .menu-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .menu-form-group {
        margin-bottom: 20px;
        min-width: 0;
    }

    .menu-form-group.full {
        grid-column: 1 / -1;
    }

    .menu-form-group label {
        display: block;
        color: #63391f;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .menu-form-group input,
    .menu-form-group textarea,
    .menu-form-group select {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 14px;
        border: 1px solid #e5d8ce;
        border-radius: 9px;
        background: #fffdfb;
        color: #4d3a2d;
        font: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .menu-form-group input:focus,
    .menu-form-group textarea:focus,
    .menu-form-group select:focus {
        border-color: #96502d;
        box-shadow: 0 0 0 3px rgba(150, 80, 45, .10);
    }

    .menu-form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .menu-form-group input[type="file"] {
        padding: 10px;
        background: #fff;
    }

    .menu-form-help {
        display: block;
        color: #948277;
        font-size: 11px;
        margin-top: 7px;
        line-height: 1.6;
    }

    .menu-form-error {
        display: block;
        color: #b42318;
        font-size: 12px;
        margin-top: 6px;
    }

    .menu-form-alert {
        background: #feecec;
        color: #b42318;
        padding: 14px 17px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .menu-form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        border-top: 1px solid #f0e7e0;
        padding-top: 22px;
        margin-top: 5px;
    }

    .menu-form-button {
        display: inline-block;
        padding: 12px 20px;
        border: none;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s;
    }

    .menu-form-button.primary {
        background: #96502d;
        color: #fff;
    }

    .menu-form-button.primary:hover {
        background: #783d21;
    }

    .menu-form-button.secondary {
        background: #f3ede7;
        color: #69432c;
    }

    .menu-form-button.secondary:hover {
        background: #e9ded4;
    }

    @media (max-width: 600px) {
        .menu-form-card {
            padding: 18px;
        }

        .menu-form-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .menu-form-group.full {
            grid-column: auto;
        }

        .menu-form-actions {
            flex-direction: column-reverse;
        }

        .menu-form-button {
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }
    }
</style>

<div class="menu-form-page">

    <div class="page-title">
        <h1>Tambah Menu</h1>
        <p>Tambahkan menu makanan baru ke daftar menu Nasi Ibu.</p>
    </div>

    <div class="card menu-form-card">

        @if ($errors->any())
            <div class="menu-form-alert">
                <strong>Periksa kembali data berikut:</strong>
                <ul style="margin:8px 0 0;padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.menu.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="menu-form-grid">

                <div class="menu-form-group">
                    <label for="nama_menu">Nama Menu *</label>
                    <input
                        type="text"
                        id="nama_menu"
                        name="nama_menu"
                        value="{{ old('nama_menu') }}"
                        placeholder="Contoh: Nasi Ayam"
                        maxlength="100"
                        required
                    >
                    @error('nama_menu')
                        <span class="menu-form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="menu-form-group">
                    <label for="kategori">Kategori *</label>
                    <input
                        type="text"
                        id="kategori"
                        name="kategori"
                        value="{{ old('kategori') }}"
                        placeholder="Contoh: Makanan"
                        maxlength="100"
                        required
                    >
                    @error('kategori')
                        <span class="menu-form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="menu-form-group">
                    <label for="harga">Harga (Rp) *</label>
                    <input
                        type="number"
                        id="harga"
                        name="harga"
                        value="{{ old('harga') }}"
                        placeholder="Contoh: 10000"
                        min="0"
                        step="1"
                        required
                    >
                    @error('harga')
                        <span class="menu-form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="menu-form-group">
                    <label for="stok">Stok (Porsi) *</label>
                    <input
                        type="number"
                        id="stok"
                        name="stok"
                        value="{{ old('stok', 0) }}"
                        placeholder="Masukkan jumlah stok"
                        min="0"
                        step="1"
                        required
                    >
                    @error('stok')
                        <span class="menu-form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="menu-form-group full">
                    <label for="deskripsi">Deskripsi Menu</label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        maxlength="1000"
                        placeholder="Ceritakan bahan atau keistimewaan menu ini..."
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="menu-form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="menu-form-group full">
                    <label for="foto">Foto Menu</label>
                    <input
                        type="file"
                        id="foto"
                        name="foto"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                    >
                    <span class="menu-form-help">
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </span>
                    @error('foto')
                        <span class="menu-form-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="menu-form-actions">
                <a href="{{ route('admin.menu.index') }}"
                   class="menu-form-button secondary">
                    Kembali
                </a>

                <button type="submit"
                        class="menu-form-button primary">
                    Simpan Menu
                </button>
            </div>

        </form>
    </div>

</div>

@endsection