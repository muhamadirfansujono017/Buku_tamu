<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Ramsey\Uuid\Guid\Guid;

class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::paginate(5);
        return view('page.guests.index')->with([
            'guests' => $guests
        ]);
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

        $data=[
            'nama' => $request->nama,
            'email' => $request->email,
            'message' =>$request->message,
            'visit_date' =>$request->visit_date,
            'is_approved' =>0,
           
        ];

        Guest::create($data);

        return back()->with('message_delete', 'Data Guests Sudah dihapus');
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
        $data = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
        ];


        $datas = Guest::findOrFail($id);
        $datas->update($data);
        return back()->with('message_delete', 'Data Outlet Sudah dihapus');
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

            return response()->json([
                'message_delete' => "Data Deleted!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete data.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
