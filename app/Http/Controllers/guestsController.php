<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class GuestsController extends Controller
{
    /**
     * Menampilkan semua data tamu.
     */
    public function index()
    {
        // Memuat relasi kategori
        $guests = Guest::with('kategori')->orderBy('tanggal', 'desc')->paginate(10);
        return view('page.guests.index', compact('guests'));
    }

    /**
     * Form untuk tambah tamu baru.
     */
    public function create()
    {
        $kategori = Kategori::all(); // untuk dropdown
        return view('page.guests.create', compact('kategori'));
    }

    /**
     * Menyimpan data tamu baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'telepon'     => 'nullable|string|max:20',
            'alamat'      => 'nullable|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'tanggal'     => 'required|date',
        ]);

        Guest::create($validated);

        return redirect()->route('guests.index')->with('success', 'Tamu berhasil ditambahkan.');
    }

    /**
     * Form untuk edit data tamu.
     */
    public function edit(Guest $guest)
    {
        $kategori = Kategori::all();
        return view('page.guests.edit', compact('guest', 'kategori'));
    }

    /**
     * Update data tamu.
     */
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
        'nama'        => 'required|string|max:255',
        'email'       => 'required|email|max:255',
        'telepon'     => 'nullable|string|max:20',
        'alamat'      => 'nullable|string|max:255',
        'kategori_id' => 'required|exists:kategori,id',
        'tanggal'     => 'required|date',
    ]);

    $guest->update($validated);

    return redirect()->route('guests.index')->with('success', 'Data tamu berhasil diperbarui.');
    }

    /**
     * Menghapus data tamu.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();

        return redirect()->route('guests.index')->with('success', 'Data tamu berhasil dihapus.');
    }
}
