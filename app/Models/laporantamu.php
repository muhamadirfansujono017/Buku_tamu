<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporantamu extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'message_id',
        'Reply_id',
        'email',
        'tanggal',
        'keterangan'
    ];

    protected $table = 'laporantamu';

    
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
