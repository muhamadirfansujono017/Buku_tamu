<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class guestsController extends Controller
{
    public function index()
    {
        $guests = Guest::orderBy('tanggal', 'desc')->paginate(10);
        return view('page.guests.index', compact('guests'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
        ]);

        Guest::create($validated);

        return redirect()->route('guests.index')->with('success', 'Tamu berhasil ditambahkan.');
    }

    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $guest->update($validated);

        return redirect()->route('guests.index')->with('success', 'Data tamu berhasil diperbarui.');
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();

        return redirect()->route('guests.index')->with('success', 'Data tamu berhasil dihapus.');
    }
}
