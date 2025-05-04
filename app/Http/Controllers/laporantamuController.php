<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Exports\MessageExport; // Pastikan file ini bernama MessageExport.php
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanTamuController extends Controller
{
    // Menampilkan data tamu dengan filter
    public function index(Request $request)
    {
        // Mengambil data yang difilter tanpa pagination
        $messages = $this->getFilteredMessages($request);
        $messageCount = $messages->count();  // Menghitung jumlah data yang difilter

        return view('laporan.index', compact('messages', 'messageCount'));
    }

    // Menampilkan halaman print (jika ingin mencetak)
    public function print(Request $request)
    {
        // Mengambil data yang difilter tanpa pagination
        $messages = $this->getFilteredMessages($request);
        return view('laporan.print', compact('messages'));
    }

    // Mengekspor data ke dalam Excel
    public function export(Request $request)
    {
        // Mendapatkan data yang difilter untuk diekspor
        $messages = $this->getFilteredMessages($request);
        return Excel::download(new MessageExport($messages), 'laporan_tamu.xlsx');
    }

    // Fungsi untuk mendapatkan pesan berdasarkan filter
    private function getFilteredMessages(Request $request)
    {
        $query = Message::with('guest'); // Mengambil data tamu beserta pesan

        // Filter berdasarkan tanggal jika ada
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            if ($this->validateDate($startDate) && $this->validateDate($endDate)) {
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            }
        }

        // Mengambil seluruh data tanpa pagination
        return $query->latest()->get();  // Mengambil semua data tanpa pagination
    }

    // Validasi format tanggal
    private function validateDate($date)
    {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $date);
    }
}
