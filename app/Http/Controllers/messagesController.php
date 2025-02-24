<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use App\Models\guests; // Ubah model menjadi lowercase

class messagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::all();
        return view('guests.index', compact('guests')); // Tampilkan data ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guests.create'); // Menampilkan form input
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'nullable|string',
        ]);

        // Simpan data
        $guest = new Guest();
        $guest->nama = $request->nama;
        $guest->email = $request->email;
        $guest->message = $request->message ?? 'No message provided';
        $guest->save();

        return redirect()->route('guests.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guest = Guest::findOrFail($id);
        return view('guests.show', compact('guest')); // Tampilkan data spesifik
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guest = Guest::findOrFail($id);
        return view('guests.edit', compact('guest')); // Form edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'nullable|string',
        ]);

        // Update data
        $guest = Guest::findOrFail($id);
        $guest->nama = $request->nama;
        $guest->email = $request->email;
        $guest->message = $request->message ?? 'No message provided';
        $guest->save();

        return redirect()->route('guests.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return redirect()->route('guests.index')->with('success', 'Data berhasil dihapus!');
    }
}
