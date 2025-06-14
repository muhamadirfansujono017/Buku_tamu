<?php

namespace App\Exports;

use App\Models\Message;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanTamuExport implements FromCollection, WithHeadings
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        $query = Message::with('guest');

        if ($this->start_date) {
            $query->whereDate('tanggal', '>=', $this->start_date);
        }

        if ($this->end_date) {
            $query->whereDate('tanggal', '<=', $this->end_date);
        }

        return $query->get()->map(function ($item) {
            return [
                'Nama' => $item->guest->nama ?? '-',
                'Email' => $item->email,
                'Telepon' => $item->telepon ?? '-',
                'Alamat' => $item->alamat ?? '-',
                'Kategori' => $item->kategori_id ?? '-',
                'Tanggal' => $item->tanggal,
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama', 'Email', 'Telepon', 'Alamat', 'Kategori', 'Tanggal'];
    }
}
