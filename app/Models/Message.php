<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;


    protected $table = 'message';

    protected $fillable = [
        'guest_id',
        'email',
        'telepon',
        'alamat',
        'kategori_id',
        'tanggal',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }


     public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
