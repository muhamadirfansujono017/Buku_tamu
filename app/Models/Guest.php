<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;  
use App\Models\Reply;    

class Guest extends Model
{
    use HasFactory;

    
    protected $table = 'guests';

    protected $fillable = [
        'nama',
        'email',
        'message',
        'visit_date',
        'is_approved',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'guest_id');
    }

   
    public function replies()
    {
        return $this->hasMany(Reply::class, 'guest_id');
    }
}
