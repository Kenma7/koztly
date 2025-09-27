<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    use HasFactory;

    protected $table = 'booking';
    protected $primaryKey = 'id_booking';

      protected $fillable = [
        'id_user',
        'id_kamar',
        'tanggal_booking',
        'status',
    ];

    // Relasi ke User (1 booking milik 1 user)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Kamar (1 booking milik 1 kamar)
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }

    // Relasi opsional ke Kost (lewat Kamar)
    public function kost()
    {
        return $this->hasOneThrough(
            Kosan::class,   // Model tujuan
            Kamar::class,  // Model perantara
            'id_kamar',    // Foreign key di tabel kamar
            'id_kos',      // Foreign key di tabel kosan
            'id_kamar',    // Foreign key di tabel booking
            'id_kos'       // Local key di tabel kamar
        );
    }
}