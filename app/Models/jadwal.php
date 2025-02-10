<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'no_penerbangan',
        'id_pesawat',
        'keberangkatan',
        'tujuan',
        'date',
        'boarding_time',
        'harga',
        'gerbang'
    ];

    protected $casts = [
        'date' => 'date',
        'boarding_time' => 'datetime'
    ];

    public function maskapai()
    {
        return $this->belongsTo(Maskapai::class, 'id_pesawat', 'id');
    }

    public function bandaraKeberangkatan()
    {
        return $this->belongsTo(Bandara::class, 'keberangkatan', 'id_bandara');
    }

    public function bandaraTujuan()
    {
        return $this->belongsTo(Bandara::class, 'tujuan', 'id_bandara');
    }
}
