<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $pelayananUnik = Kategori::select('pelayanan')->distinct()->pluck('pelayanan');

    $data = Kategori::select('pelayanan',DB::raw('count(*) as total'))
        ->whereIn('pelayanan', $pelayananUnik)
        ->groupBy('pelayanan')
        ->orderByRaw("FIELD(pelayanan, 'Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Buruk')")
        ->get();

    $labels = $data->pluck('pelayanan');
    $values = $data->pluck('total');

    return view('page.pelayanan.grafik', compact('labels', 'values'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
