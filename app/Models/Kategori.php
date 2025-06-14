<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    use HasFactory;

    protected $fillable = [
        'data_tujuan',

    ];

    public function guests()
    {
        return $this->hasMany(Guest::class, 'kategori_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'kategori_id');
    }
}
