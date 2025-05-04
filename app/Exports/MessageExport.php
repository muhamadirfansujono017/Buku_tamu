<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class MessageExport implements FromCollection, WithHeadings
{
    protected $messages;

    public function __construct(Collection $messages)
    {
        $this->messages = $messages;
    }

    public function collection()
    {
        return $this->messages->map(function ($item) {
            return [
                'Nama Tamu' => $item->guest->nama ?? 'Tamu Tidak Ditemukan',
                'Email'     => $item->email,
                'Telepon'   => $item->telepon ?? 'Tidak Diketahui',
                'Alamat'    => $item->alamat ?? 'Tidak Diketahui',
                'Tujuan'    => $item->tujuan ?? 'Tidak Diketahui',
                'Pesan'     => $item->pesan,
                'Tanggal'   => Carbon::parse($item->tanggal)->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama Tamu', 'Email', 'Telepon', 'Alamat', 'Tujuan', 'Pesan', 'Tanggal'];
    }
}
