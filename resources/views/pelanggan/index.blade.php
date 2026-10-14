@extends('layouts.app')

@section('title', 'Pelanggan')

@section('content')

<div class="page-title">
    <h1>Pelanggan</h1>
    <p>Daftar pelanggan berdasarkan transaksi yang sudah tercatat.</p>
</div>

<div class="card">

    <div class="card-header">
        <div>
            <h2>Daftar Pelanggan</h2>
            <p>Pelanggan yang pernah melakukan transaksi.</p>
        </div>
    </div>

    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Jumlah Transaksi</th>
                    <th>Total Belanja</th>
                </tr>
            </thead>

            <tbody>

                @forelse($pelanggan as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <strong>
                                {{ $item->nama_pelanggan }}
                            </strong>
                        </td>

                        <td>
                            {{ $item->jumlah_transaksi }} transaksi
                        </td>

                        <td>
                            <strong>
                                Rp {{ number_format($item->total_belanja, 0, ',', '.') }}
                            </strong>
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="4"
                            style="
                                text-align:center;
                                padding:45px 20px;
                                color:#999;
                            "
                        >

                            <div style="
                                font-size:40px;
                                margin-bottom:10px;
                            ">
                                👥
                            </div>

                            <strong style="
                                display:block;
                                color:#555;
                                margin-bottom:8px;
                            ">
                                Belum ada pelanggan
                            </strong>

                            <span>
                                Data pelanggan akan muncul setelah
                                transaksi memiliki nama pelanggan.
                            </span>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection