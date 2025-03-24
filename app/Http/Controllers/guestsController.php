<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $guest = Guest::paginate(5);
            return view('page.guests.index')->with([
                'guests' => $guest,
            ]);
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " .
                addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guests.create');   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try {
        $data=[
            'nama' => $request->nama,
            'email' => $request->email,
           
        ];

        Guest::create($data);
       // return back()->with('message_delete', 'Data Guests Sudah dihapus');

        //     return redirect()
        //         ->route('guest.index')
        //         ->with('message_insert', 'Data guest Sudah ditambahkan');
        // } catch (\Exception $e) {
        //     echo "<script>console.error('PHP Error: " .
        //     addslashes($e->getMessage()) . "');</script>";
        //     return view('error.index');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $guest = Guest::findOrFail($id);
        return view('guests.show', compact('guest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        return view('guests.edit', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
        $data = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
        ];


        $datas = Guest::findOrFail($id);
        $datas->update($data);
        //return back()->with('message_delete', 'Data Outlet Sudah dihapus');

                return redirect()
                ->route('guest.index')
                ->with('message_insert', 'Data guest Sudah ditambahkan');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " .
                addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Guest::findOrFail($id);
            $data = Guest::where('id', $id)->first();

            $data->delete();

            return back()->with('message_delete', 'Data Peserta Sudah dihapus');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " .
                addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }
}
