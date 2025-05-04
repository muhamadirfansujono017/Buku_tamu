<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestsController extends Controller
{
    public function index()
    {
        $guests = Guest::latest()->paginate(5);
        return view('page.guests.index', compact('guests'));
    }

    public function create()
    {
        return view('page.guests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'pesan' => 'required|string|max:1000',
            'tanggal' => 'required|date',
        ]);

        try {
            Guest::create($request->only([
                'nama', 'email', 'telepon', 'alamat', 'tujuan', 'pesan', 'tanggal'
            ]));

            return redirect()->route('guests.index')->with('success', 'Data guest berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $guest = Guest::findOrFail($id);
        return view('page.guests.show', compact('guest'));
    }

    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        return view('page.guests.edit', compact('guest'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'pesan' => 'required|string|max:1000',
            'tanggal' => 'required|date',
        ]);

        try {
            $guest = Guest::findOrFail($id);
            $guest->update($request->only([
                'nama', 'email', 'telepon', 'alamat', 'tujuan', 'pesan', 'tanggal'
            ]));

            return redirect()->route('guests.index')->with('success', 'Data guest berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $guest = Guest::findOrFail($id);
            $guest->delete();

            return back()->with('success', 'Data guest berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
