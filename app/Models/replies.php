<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class replies extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'user_id',
       'reply_text',
    ];
}
