@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')

<div class="page-title">
    <h1>Pengaturan</h1>
    <p>Kelola informasi usaha dan profil sistem.</p>
</div>

<div class="card">

    <div class="card-header">
        <div>
            <h2>Profil Usaha</h2>
            <p>Informasi dasar usaha Nasi Ibu.</p>
        </div>
    </div>

    <form
        action="/pengaturan"
        method="POST"
        class="settings-form"
    >

        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Nama Usaha</label>
            <input
                type="text"
                name="nama_usaha"
                class="form-control"
                value="{{ old('nama_usaha', $pengaturan->nama_usaha) }}"
                required
            >
        </div>

        <div class="form-group">
            <label class="form-label">Nama Pemilik</label>
            <input
                type="text"
                name="nama_pemilik"
                class="form-control"
                value="{{ old('nama_pemilik', $pengaturan->nama_pemilik) }}"
                placeholder="Nama pemilik usaha"
            >
        </div>

        <div class="form-group">
            <label class="form-label">Nomor HP</label>
            <input
                type="text"
                name="no_hp"
                class="form-control"
                value="{{ old('no_hp', $pengaturan->no_hp) }}"
                placeholder="Contoh: 08xxxxxxxxxx"
            >
        </div>

        <div class="form-group">
            <label class="form-label">Alamat</label>
            <textarea
                name="alamat"
                class="form-control"
                rows="4"
                placeholder="Alamat usaha"
            >{{ old('alamat', $pengaturan->alamat) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi Usaha</label>
            <textarea
                name="deskripsi"
                class="form-control"
                rows="4"
                placeholder="Deskripsi singkat usaha"
            >{{ old('deskripsi', $pengaturan->deskripsi) }}</textarea>
        </div>

        <div style="
            margin-top:25px;
            padding-top:18px;
            border-top:1px solid #eee;
        ">
            <button type="submit" class="btn btn-primary">
                💾 Simpan Pengaturan
            </button>
        </div>

    </form>

</div>

@endsection
 