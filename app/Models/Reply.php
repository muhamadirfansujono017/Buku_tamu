<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_guest',
        'message',
        'email',
        'tanggal'
    ];

    protected $table = 'reply';
}
