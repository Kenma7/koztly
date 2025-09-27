<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kosan extends Model
{
    use HasFactory;

    protected $table = 'kosan';
    protected $primaryKey = 'id_kos';
    protected $fillable = [
        'nama_kos',
        'lokasi_kos',
        'harga',
        'jumlah_kamar',
        'fasilitas',
        'kategori',
        'status',
        'gambar_kos',
        'no_rek',
    ];

    // Relasi: satu kosan punya banyak kamar
    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'id_kos');
    }

    // Relasi opsional: satu kosan punya banyak booking lewat kamar
    public function bookings()
    {
        return $this->hasManyThrough(
            Booking::class, // model tujuan
            Kamar::class,   // model perantara
            'id_kos',       // foreign key di tabel kamar
            'id_kamar',     // foreign key di tabel booking
            'id_kos',       // local key di tabel kosan
            'id_kamar'      // local key di tabel kamar
        );
    }
}
