<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::with('guest')->paginate(5);  // Memuat data tamu
        $guests = Guest::all();  // Ambil semua data tamu

        return view('page.messages.index', [
            'messages' => $messages,
            'guests' => $guests
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tidak ada form create, hanya mengarah ke index.
        return redirect()->route('message.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inputan user
        $request->validate([
            'guest_id' => 'required|exists:guests,id',  // Guest id yang valid
            'pesan' => 'required|string|max:1000',  // Pesan tidak boleh kosong
            'tanggal' => 'required|date',  // Tanggal harus ada
        ]);

        // Simpan data pesan baru
        Message::create([
            'guest_id' => $request->guest_id,  // Menyimpan id guest
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'tujuan' => $request->tujuan,
            'pesan' => $request->pesan,
            'tanggal' => $request->tanggal,
        ]);

        // Redirect kembali ke halaman index
        return redirect()
            ->route('message.index')
            ->with('message_insert', 'Data pesan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tidak digunakan, redirect ke index.
        return redirect()->route('message.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tidak ada form edit, redirect ke index.
        return redirect()->route('message.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi inputan untuk update
        $request->validate([
            'guest_id_edit' => 'required|exists:guests,id',  // Guest id yang valid
            'pesan' => 'required|string|max:1000',  // Pesan tidak boleh kosong
            'tanggal' => 'required|date',  // Tanggal harus ada
        ]);

        // Cari pesan yang akan diupdate
        $message = Message::findOrFail($id);
        $message->update([
            'guest_id' => $request->guest_id_edit,  // Update id tamu
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'tujuan' => $request->tujuan,
            'pesan' => $request->pesan,
            'tanggal' => $request->tanggal,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()
            ->route('message.index')
            ->with('message_update', 'Data pesan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari pesan yang akan dihapus
        $message = Message::findOrFail($id);
        $message->delete();  // Hapus pesan

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('message_delete', 'Data pesan berhasil dihapus.');
    }
}
