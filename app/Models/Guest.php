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
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'guest_id');
    }
}
