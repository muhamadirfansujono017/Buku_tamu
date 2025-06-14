<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Guest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('guest', 'kategori')->latest()->get();
        return view('page.message.index', compact('messages'));
    }

    public function create()
    {
        $guests = Guest::all();
        $kategoris = Kategori::all(); // Nama variabel boleh jamak, tabel tetap 'kategori'
        return view('page.message.create', compact('guests', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guest_id'    => 'required|exists:guests,id',
            'email'       => 'required|email',
            'telepon'     => 'required|string',
            'alamat'      => 'required|string',
            'kategori_id' => 'required|exists:kategori,id', // Validasi tetap 'kategori'
            'tanggal'     => 'required|date',
        ]);

        Message::create($request->all());

        return redirect()->route('message.index')->with('success', 'Pesan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $message = Message::with('guest', 'kategori')->findOrFail($id);
        return view('page.message.show', compact('message'));
    }

    public function edit($id)
    {
        $message   = Message::findOrFail($id);
        $guests    = Guest::all();
        $kategoris = Kategori::all();

        return view('page.message.edit', compact('message', 'guests', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'guest_id'    => 'required|exists:guests,id',
            'email'       => 'required|email',
            'telepon'     => 'required|string',
            'alamat'      => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'tanggal'     => 'required|date',
        ]);

        $message = Message::findOrFail($id);
        $message->update($request->all());

        return redirect()->route('message.index')->with('success', 'Pesan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('message.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
