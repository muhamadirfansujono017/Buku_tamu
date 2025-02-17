<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guests extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'message',
        'visit_date',
        'is_approved'
    ];
}
