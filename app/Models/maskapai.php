<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class maskapai extends Model
{
    use HasFactory;
    protected $table = 'maskapais';
    protected $fillable = [
        'id_pesawat',
        'nama_maskapai',
        'nama_pesawat',
        'jenis_pesawat',
        'jumlah_kursi',
        'kursi_perbaris'
    ];
}
