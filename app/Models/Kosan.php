<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kosan extends Model
{
    use HasFactory;

    protected $table = 'kosan';
    protected $primaryKey = 'id_kos';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nama_kos',
        'lokasi_kos',
        'harga',
        'jumlah_kamar',
        'fasilitas',
        'kategori',
        'status',
        'deskripsi',
        'gambar_kos',
        'no_rek',
    ];

    // Relasi: satu kosan punya banyak kamar
    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'id_kos', 'id_kos');
    }

    // Method hitung sisa kamar tersedia
    public function sisaKamar()
    {
        // Hitung kamar dengan status 'tersedia'
        return $this->kamar()
                    ->where('status', 'tersedia')
                    ->count();
    }

    // Method untuk total kamar (dari database kamar)
    public function totalKamar()
    {
        return $this->kamar()->count();
    }

    // Accessor untuk sisa kamar (alternatif)
    public function getSisaKamarAttribute()
    {
        return $this->sisaKamar();
    }

    // Relasi opsional: satu kosan punya banyak booking lewat kamar
    public function bookings()
    {
        return $this->hasManyThrough(
            Booking::class,
            Kamar::class,
            'id_kos',
            'id_kamar', 
            'id_kos',
            'id_kamar'
        );
    }
}