<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanTamuExport;

class LaporanTamuController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::query();

        if ($request->start_date) {
            $messages->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $messages->whereDate('tanggal', '<=', $request->end_date);
        }

        $data = $messages->with('guest')->latest()->get();

        return view('laporan.index', [
            'messages' => $data,
            'messageCount' => $data->count()
        ]);
    }

    public function export(Request $request)
    {
        return Excel::download(new LaporanTamuExport($request->start_date, $request->end_date), 'laporan_tamu.xlsx');
    }

    public function print(Request $request)
    {
        $messages = Message::query();

        if ($request->start_date) {
            $messages->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $messages->whereDate('tanggal', '<=', $request->end_date);
        }

        $data = $messages->with('guest')->get();

        return view('laporan.print', ['messages' => $data]);
    }
}
