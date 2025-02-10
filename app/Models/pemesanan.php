<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'pemesanans';

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'no_pemesanan',
        'no_penerbangan',
        'bangku_code',
        'jumlah_penumpang',
        'pembayaran',
        'bukti_pembayaran',
        'status_pesanan',
        'total_harga',
        'user_id',
    ];

    // Relasi dengan model Schedules
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'no_penerbangan', 'no_penerbangan');
    }

    // Relasi dengan model Bangku
    public function bangku()
    {
        return $this->belongsTo(Seat::class, 'bangku_code', 'bangku_code')
            ->withDefault();
    }

    // Tambahkan relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // // Tambahkan relasi dengan konfirmasi_pembayaran
    // public function konfirmasi_pembayaran()
    // {
    //     return $this->hasOne(konfirmasi_pembayarans::class, 'id_pemesanan');
    // }
}
