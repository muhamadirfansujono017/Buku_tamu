<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class LaporanTamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query untuk mengambil data pesan
        $message = Message::query();

        // Filter berdasarkan tanggal jika ada
        if ($request->has('start_date') && $request->has('end_date')) {
            $message = $message->whereBetween('tanggal', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // Ambil data pesan dengan get
        $message = $message->get();

        // Hitung jumlah pesan
        $messageCount = $message->count();

        // Kembalikan view dengan data pesan dan jumlah pesan
        return view('laporan.index', compact('message', 'messageCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Method ini tidak digunakan, jika Anda ingin membuat form, tambahkan di sini.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mengambil tanggal mulai dan tanggal sampai dari request
        $dari = $request->input('dari', 'all');
        $sampai = $request->input('sampai', 'all');

        // Jika 'all', set nilai null
        if ($dari === 'all') $dari = null;
        if ($sampai === 'all') $sampai = null;

        // Jika tidak ada filter tanggal, ambil semua data pesan
        if ($dari === null) {
            $data = Message::all();
        } else {
            // Jika ada filter tanggal, ambil pesan berdasarkan rentang tanggal
            $data = Message::whereBetween('tanggal', [$dari, $sampai])->get();
        }

        // Kembalikan view print dengan data pesan
        return view('laporan.print', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Method ini bisa digunakan jika Anda ingin menampilkan detail dari pesan tertentu.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Method ini bisa digunakan untuk form edit data, jika perlu.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Method ini bisa digunakan untuk update data pesan jika diperlukan.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Method ini bisa digunakan untuk menghapus data pesan jika diperlukan.
    }
}
