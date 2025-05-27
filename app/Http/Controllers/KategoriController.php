<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kategori::query();

        if ($request->filled('nama')) {
            $query->where('nama', $request->nama);
        }

        $kategori = $query->orderBy('created_at', 'desc')->paginate(10); 

        $allNama = Kategori::pluck('nama')->unique(); 

        return view('page.kategori.index', compact('kategori', 'allNama'));
    }


    /**
     * Show the form for creating a new resource.
     */
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
