<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    /**
     * Menampilkan semua balasan.
     */
    public function index()
    {
        $replies = Reply::all();
        return view('replies.index', compact('replies'));
    }

    /**
     * Menyimpan balasan baru untuk pesan tertentu.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message_id' => 'required|exists:messages,id',
            'reply' => 'required|string|max:500',
        ]);

        Reply::create($validated);

        return redirect()->back()->with('success', 'Balasan berhasil dikirim.');
    }

    /**
     * Menampilkan detail balasan berdasarkan ID.
     */
    public function show(Reply $reply)
    {
        return view('replies.show', compact('reply'));
    }

    /**
     * Mengedit balasan tertentu.
     */
    public function edit(Reply $reply)
    {
        return view('replies.edit', compact('reply'));
    }

    /**
     * Memperbarui balasan yang sudah ada.
     */
    public function update(Request $request, Reply $reply)
    {
        $validated = $request->validate([
            'reply' => 'required|string|max:500',
        ]);

        $reply->update($validated);

        return redirect()->route('replies.index')->with('success', 'Balasan berhasil diperbarui.');
    }

    /**
     * Menghapus balasan tertentu.
     */
    public function destroy(Reply $reply)
    {
        $reply->delete();

        return redirect()->back()->with('success', 'Balasan berhasil dihapus.');
    }
}
