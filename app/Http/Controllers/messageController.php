<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Tampilkan daftar pesan.
     */
    public function index()
    {
        $messages = Message::with('guest')->latest()->paginate(5);
        $guests = Guest::all();

        return view('page.messages.index', compact('messages', 'guests'));
    }

    /**
     * Form tambah data pesan (opsional).
     */
    public function create()
    {
        $guests = Guest::all();
        return view('page.messages.create', compact('guests'));
    }

    /**
     * Simpan pesan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'email'    => 'required|email',
            'telepon'  => 'required|string|max:20',
            'alamat'   => 'required|string|max:255',
            'tujuan'   => 'required|string|max:255',
            'tanggal'  => 'required|date',
        ]);

        Message::create($request->only([
            'guest_id', 'email', 'telepon', 'alamat', 'tujuan','tanggal'
        ]));

        return redirect()->route('message.index')->with('message_insert', 'Data pesan berhasil ditambahkan.');
    }

    /**
     * Tidak digunakan.
     */
    public function show(string $id)
    {
        return redirect()->route('message.index');
    }

    /**
     * Form edit data pesan (opsional).
     */
    public function edit(string $id)
    {
        $message = Message::findOrFail($id);
        $guests = Guest::all();
        return view('page.messages.edit', compact('message', 'guests'));
    }

    /**
     * Update data pesan.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'email'    => 'required|email',
            'telepon'  => 'required|string|max:20',
            'alamat'   => 'required|string|max:255',
            'tujuan'   => 'required|string|max:255',
            'tanggal'  => 'required|date',
        ]);

        $message = Message::findOrFail($id);
        $message->update($request->only([
            'guest_id', 'email', 'telepon', 'alamat', 'tujuan','tanggal'
        ]));

        return redirect()->route('message.index')->with('message_update', 'Data pesan berhasil diperbarui.');
    }

    /**
     * Hapus data pesan.
     */
    public function destroy(string $id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return back()->with('message_delete', 'Data pesan berhasil dihapus.');
    }
}
