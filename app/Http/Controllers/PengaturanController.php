<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
{
    $pengaturan = Pengaturan::first();

    if (!$pengaturan) {
        $pengaturan = Pengaturan::create([
            'nama_usaha' => 'Nasi Ibu',
            'nama_pemilik' => '',
            'no_hp' => '',
            'alamat' => '',
            'deskripsi' => 'Masakan rumahan, penuh kasih.',
        ]);
    }

    return view('pengaturan.index', compact('pengaturan'));
}

    public function update(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required|max:100',
            'nama_pemilik' => 'nullable|max:100',
            'no_hp' => 'nullable|max:20',
            'alamat' => 'nullable',
            'deskripsi' => 'nullable',
        ]);

        $pengaturan = Pengaturan::first();

        $pengaturan->update([
            'nama_usaha' => $request->nama_usaha,
            'nama_pemilik' => $request->nama_pemilik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/pengaturan')
            ->with('success', 'Pengaturan berhasil diperbarui!');
    }
}