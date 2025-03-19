<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use App\Models\Message;

class messageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::paginate(5);
        $guests = Guest::all();
        return view('page.messages.index')->with([
            'message' => $messages,
            'guests'  => $guests
        ]);
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
        
        $data = [
            'guest_id' => $request->input('guest_id'),
            'message' => $request->input('message'),
        ];

        Message::create($data);
        return back()->with('message_delete', 'Data Message Sudah dihapus');
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

        
        $data = [
            'guest_id' => $request->input('guest_id_edit'),
            'message' => $request->input('message'),
        ];

        $datas = Message::findOrFail($id);
        $datas->update($data);
        return back()->with('message_delete', 'Data Paket Sudah dihapus');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Message::findOrFail($id);
            $data = Message::where('id', $id)->first();

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
