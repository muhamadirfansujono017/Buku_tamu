<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestsController extends Controller
{
    public function index()
    {
        $guests = Guest::paginate(5);
        return view('page.guests.index', compact('guests'));
    }

    public function create()
    {
        $guests = Guest::all();
        return view('message.create', compact('guests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'pesan' => 'required|string|max:1000',
            'tanggal' => 'required|date',
        ]);

        Guest::create([
            'guest_id' => $request->guest_id,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'tujuan' => $request->tujuan,
            'pesan' => $request->pesan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('message.index')->with('success', 'Pesan berhasil ditambahkan');
    }

    public function show($id)
    {
        $guest = Guest::findOrFail($id);
        return view('guests.show', compact('guest'));
    }

    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        return view('guests.edit', compact('guest'));
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

        $guest = Guest::findOrFail($id);
        $guest->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'tujuan' => $request->tujuan,
            'pesan' => $request->pesan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('guest.index')->with('message_update', 'Data guest berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return back()->with('message_delete', 'Data guest berhasil dihapus.');
    }
}
