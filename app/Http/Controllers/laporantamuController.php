<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Exports\MessageExport; 
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanTamuController extends Controller
{
    
    public function index(Request $request)
    {
        
        $messages = $this->getFilteredMessages($request);
        $messageCount = $messages->count();  

        return view('laporan.index', compact('messages', 'messageCount'));
    }

    public function print(Request $request)
    {
       
        $messages = $this->getFilteredMessages($request);
        return view('laporan.print', compact('messages'));
    }

    
    public function export(Request $request)
    {
    
        $messages = $this->getFilteredMessages($request);
        return Excel::download(new MessageExport($messages), 'laporan_tamu.xlsx');
    }


    private function getFilteredMessages(Request $request)
    {
        $query = Message::with('guest');

       
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            if ($this->validateDate($startDate) && $this->validateDate($endDate)) {
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            }
        }

       
        return $query->latest()->get(); 
    }


    private function validateDate($date)
    {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $date);
    }
}
