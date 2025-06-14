<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelayananController extends Controller
{
    /**
     * Tampilkan grafik kepuasan pelayanan berdasarkan kolom kategori di tabel guests.
     */
    public function index()
    {
        // Ambil daftar nilai kategori unik dari tabel guests
        $data = DB::table('guests')
        ->select('kategori_id', DB::raw('COUNT(*) as total'))
        ->groupBy('kategori_id')
        ->get();

    // Persiapkan label dan value untuk chart
    $labels = [];
    $values = [];

    foreach ($data as $item) {
        $kategoriName = Kategori::where('id', $item->kategori_id)->value('data_tujuan') ?? 'Tidak Diketahui';
        $labels[] = $kategoriName;
        $values[] = $item->total;
    }

    return view('page.pelayanan.grafik', compact('labels', 'values'));
    }

    // Matikan semua method lainnya
    public function create() { return abort(404); }
    public function store(Request $request) { return abort(404); }
    public function show(string $id) { return abort(404); }
    public function edit(string $id) { return abort(404); }
    public function update(Request $request, string $id) { return abort(404); }
    public function destroy(string $id) { return abort(404); }
}
