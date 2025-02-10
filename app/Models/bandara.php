<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bandara extends Model
{
    use HasFactory;
    protected $table = 'bandaras';
    protected $fillable = [
        'id_bandara',
        'nama_bandara',
        'kota',
        'negara'
    ];
}
