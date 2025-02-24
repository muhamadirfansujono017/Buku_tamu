<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'user_id',
        'reply_text',
    ];

    protected $table = 'replies';

   
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id', 'id');
    }

    
    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function createCode()
    {
        $latestCode = self::orderBy('kode_invoice', 'desc')->value('kode_invoice');
        $latestCodeNumber = intval(substr($latestCode, 2));
        $nextCodeNumber = $latestCodeNumber ? $latestCodeNumber + 1 : 1;
        $formattedCodeNumber = sprintf("%05d", $nextCodeNumber);
        return 'T' . $formattedCodeNumber;
    }
}
