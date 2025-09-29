<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking_kos'; // Nama tabel yang benar
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'id_user',
        'id_kos',
        'id_kamar',
        'harga',
        'status_pembayaran',
        'bukti_tf',
        'status_sewa',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }

    // Relasi ke Kosan (langsung, bukan lewat kamar)
    public function kost()
    {
        return $this->belongsTo(Kosan::class, 'id_kos', 'id_kos');
    }
}