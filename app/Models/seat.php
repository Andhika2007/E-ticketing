<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class seat extends Model
{
    use HasFactory;

    protected $table = 'seats';

    protected $fillable = [
        'id_pesawat',
        'bangku_code'
    ];

    public function maskapai()
    {
        return $this->belongsTo(maskapai::class, 'id_pesawat', 'id_pesawat');
    }
}
