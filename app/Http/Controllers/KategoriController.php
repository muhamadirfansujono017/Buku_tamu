<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Tampilkan semua data kategori dengan paginasi.
     */
    public function index()
    {
        $kategori = Kategori::paginate(10);
        return view('page.kategori.index', compact('kategori'));
    }

    /**
     * Tampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('page.kategori.create');
    }

    /**
     * Simpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'data_tujuan' => 'required|string|max:255',
        ]);

        Kategori::create([
            'data_tujuan' => $request->data_tujuan,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengedit kategori.
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('page.kategori.edit', compact('kategori'));
    }

    /**
     * Simpan perubahan pada kategori.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'data_tujuan' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'data_tujuan' => $request->data_tujuan,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori dari database.
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
