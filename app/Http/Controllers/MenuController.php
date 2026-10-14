<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();

        return view('menu.index', compact('menus'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_menu' => 'required',
        'deskripsi' => 'nullable',
        'harga' => 'required|numeric',
        'kategori' => 'required',
        'stok' => 'required|integer',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $foto = null;

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('menus', 'public');
    }

    Menu::create([
        'nama_menu' => $request->nama_menu,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'kategori' => $request->kategori,
        'foto' => $foto,
        'stok' => $request->stok,
        'status' => 'tersedia',
    ]);

    return redirect('/menu')
        ->with('success', 'Menu berhasil ditambahkan!');
}

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_menu' => 'required',
        'deskripsi' => 'nullable',
        'harga' => 'required|numeric',
        'kategori' => 'required',
        'stok' => 'required|integer',
        'status' => 'required|in:tersedia,habis',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $menu = Menu::findOrFail($id);

    $foto = $menu->foto;

    if ($request->hasFile('foto')) {

        if ($menu->foto) {
            Storage::disk('public')->delete($menu->foto);
        }

        $foto = $request->file('foto')->store('menus', 'public');
    }

    $menu->update([
        'nama_menu' => $request->nama_menu,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'kategori' => $request->kategori,
        'foto' => $foto,
        'stok' => $request->stok,
        'status' => $request->status,
    ]);

    return redirect('/menu')
        ->with('success', 'Menu berhasil diperbarui!');
}

    public function destroy($id)
{
    $menu = Menu::findOrFail($id);

    $menu->delete();

    return redirect('/menu')
        ->with('success', 'Menu berhasil dihapus!');
}
}