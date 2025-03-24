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
        try{

            $messages = Message::paginate(5);
            $guests = Guest::all();
            return view('page.messages.index')->with([
                'message' => $messages,
                'guests'  => $guests
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
       // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $data = [
                'guest_id' => $request->input('guest_id'),
                'message' => $request->input('message'),
            ];

            Message::create($data);
            //return back()->with('message_delete', 'Data Message Sudah dihapus');

                return redirect()
                ->route('message.index')
                ->with('message_insert', 'Data message Sudah ditambahkan');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " .
                addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
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

        try{
        $data = [
            'guest_id' => $request->input('guest_id_edit'),
            'message' => $request->input('message'),
        ];

        $datas = Message::findOrFail($id);
        $datas->update($data);
        //return back()->with('message_delete', 'Data Paket Sudah dihapus');

                return redirect()
                ->route('message.index')
                ->with('message_insert', 'Data message Sudah ditambahkan');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " .
                addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    
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

            return back()->with('message_delete', 'Data Customer Sudah dihapus');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " .
                addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
        
    }
}
