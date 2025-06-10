<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;      

class Guest extends Model
{
    use HasFactory;

    
    protected $table = 'guests';

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'alamat',
        'tujuan',
        'tanggal',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'guest_id');
    }
}
