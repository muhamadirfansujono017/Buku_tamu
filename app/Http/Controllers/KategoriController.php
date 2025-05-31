<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategori = Kategori::paginate(10);
        return view('page.kategori.index', compact('kategori'));
    }
    public function grafikKepuasan()
{
   
    $pelayananUnik = Kategori::select('pelayanan')->distinct()->pluck('pelayanan');

    $data = Kategori::select('pelayanan',DB::raw('count(*) as total'))
        ->whereIn('pelayanan', $pelayananUnik)
        ->groupBy('pelayanan')
        ->orderByRaw("FIELD(pelayanan, 'Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Buruk')")
        ->get();

    $labels = $data->pluck('pelayanan');
    $values = $data->pluck('total');

    return view('page.kategori.grafik', compact('labels', 'values'));
}

    public function create()
{
    return view('page.kategori.create');
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'keperluan' => 'required',
            'pelayanan' => 'required',
            'tanggal' => 'required|date',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('page.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'keperluan' => 'required',
            'pelayanan' => 'required',
            'tanggal' => 'required|date',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil dihapus.');
    }
}
