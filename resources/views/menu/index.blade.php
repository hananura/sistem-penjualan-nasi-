
@extends('layouts.app')

@section('title', 'Kelola Menu')

@section('content')

<div class="page-title">
    <h1>Kelola Menu</h1>
    <p>Tambah, edit, dan kelola menu makanan Nasi Ibu.</p>
</div>

<div class="card">

    <div class="card-header">
        <div>
            <h2>Daftar Menu</h2>
            <p>Semua menu makanan yang tersedia di sistem.</p>
        </div>

        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">
            + Tambah Menu
        </a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($menus as $menu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            @if($menu->foto)
                                <img
                                    src="{{ asset('storage/' . $menu->foto) }}"
                                    alt="{{ $menu->nama_menu }}"
                                    style="width:65px;height:50px;object-fit:cover;border-radius:7px;"
                                >
                            @else
                                <div style="
                                    width:65px;
                                    height:50px;
                                    background:#f3dfc5;
                                    border-radius:7px;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    font-size:22px;
                                ">
                                    🍚
                                </div>
                            @endif
                        </td>

                        <td>
                            <strong>{{ $menu->nama_menu }}</strong>

                            @if($menu->deskripsi)
                                <div style="
                                    font-size:11px;
                                    color:#999;
                                    margin-top:4px;
                                    max-width:220px;
                                ">
                                    {{ $menu->deskripsi }}
                                </div>
                            @endif
                        </td>

                        <td>
                            <strong>
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </strong>
                        </td>

                        <td>{{ $menu->kategori }}</td>

                        <td>{{ $menu->stok }}</td>

                        <td>
                            @if($menu->status === 'tersedia' && $menu->stok > 0)
                                <span class="status status-success">
                                    Tersedia
                                </span>
                            @else
                                <span class="status status-danger">
                                    Habis
                                </span>
                            @endif
                        </td>

                        <td>
                            <a
                                href="{{ route('admin.menu.edit', $menu->id) }}"
                                class="btn btn-warning"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.menu.destroy', $menu->id) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Yakin ingin menghapus menu ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:45px 20px;color:#999;">
                            <div style="font-size:40px;margin-bottom:10px;">
                                🍚
                            </div>

                            <strong style="display:block;color:#555;margin-bottom:8px;">
                                Belum ada menu
                            </strong>

                            <span style="display:block;margin-bottom:18px;">
                                Tambahkan menu makanan pertama.
                            </span>

                            <a
                                href="{{ route('admin.menu.create') }}"
                                class="btn btn-primary"
                            >
                                + Tambah Menu
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
