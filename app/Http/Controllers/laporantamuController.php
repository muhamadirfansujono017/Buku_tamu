<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Message;
use App\Models\Reply;
use Illuminate\Http\Request;

class LaporanTamuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar balasan
     */
    public function index()
    {
        $replies = Reply::with(['guest', 'message', 'parent'])
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('replies.index', compact('replies'));
    }

    /**
     * Menampilkan form tambah balasan
     */
    public function create()
    {
        $guests = Guest::pluck('nama', 'id');
        $messages = Message::pluck('judul', 'id');
        $parentReplies = Reply::whereNull('Reply_id')->get();

        return view('replies.create', compact('guests', 'messages', 'parentReplies'));
    }

    /**
     * Menyimpan data balasan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'message_id' => 'required|exists:messages,id',
            'email' => 'required|email',
            'tanggal' => 'required|date',
            'Reply_id' => 'nullable|exists:replies,id',
            'isi_balasan' => 'required|string',
        ]);

        Reply::create([
            'guest_id' => $request->guest_id,
            'message_id' => $request->message_id,
            'Reply_id' => $request->Reply_id,
            'email' => $request->email,
            'tanggal' => $request->tanggal,
            'isi_balasan' => $request->isi_balasan,
        ]);

        return redirect()
            ->route('replies.index')
            ->with('success', 'Balasan berhasil disimpan');
    }

    /**
     * Menampilkan detail balasan
     */
    public function show($id)
    {
        $reply = Reply::with(['guest', 'message', 'parent', 'children'])
            ->findOrFail($id);

        return view('replies.show', compact('reply'));
    }

    /**
     * Menampilkan form edit balasan
     */
    public function edit($id)
    {
        $reply = Reply::findOrFail($id);
        $guests = Guest::pluck('nama', 'id');
        $messages = Message::pluck('judul', 'id');
        $parentReplies = Reply::where('id', '!=', $id)
            ->where(function ($q) use ($id) {
                $q->whereNull('Reply_id')
                  ->orWhere('id', '!=', $id);
            })
            ->get();

        return view('replies.edit', compact('reply', 'guests', 'messages', 'parentReplies'));
    }

    /**
     * Update data balasan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'message_id' => 'required|exists:messages,id',
            'email' => 'required|email',
            'tanggal' => 'required|date',
            'Reply_id' => 'nullable|exists:replies,id',
            'isi_balasan' => 'required|string',
        ]);

        $reply = Reply::findOrFail($id);
        $reply->update($request->all());

        return redirect()
            ->route('replies.index')
            ->with('success', 'Balasan berhasil diupdate');
    }

    /**
     * Hapus data balasan
     */
    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);
        $reply->delete();

        return back()->with('success', 'Balasan berhasil dihapus');
    }
}