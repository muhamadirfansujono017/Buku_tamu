<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;

class logsController extends Controller
{
    /**
     * Menampilkan daftar log aktivitas.
     */
    public function index()
    {
        $log = logs::all();
        return view('logs.index', compact('logs'));
    }

    /**
     * Menyimpan log aktivitas baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'activity' => 'required|string|max:255',
        ]);

        $log = new Logs();
        $log->guest_id = $request->guest_id;
        $log->activity = $request->activity;
        $log->save();

        return response()->json(['message' => 'Log aktivitas berhasil disimpan.']);
    }

    /**
     * Menampilkan detail log tertentu.
     */
    public function show(string $id)
    {
        $log = Logs::findOrFail($id);
        return view('logs.show', compact('log'));
    }

    /**
     * Menghapus log tertentu.
     */
    public function destroy(string $id)
    {
        $log = Logs::findOrFail($id);
        $log->delete();

        return redirect()->back()->with('success', 'Log berhasil dihapus.');
    }
}
