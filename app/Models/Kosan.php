<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kamar;
use App\Models\Booking;


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

    //sisa kamar
    public function sisaKamar()
    {
    // hitung kamar total - kamar yang sudah dibooking
    $total = $this->jumlah_kamar;
   // $dipakai = $this->bookings()->count();

    //return max($total - $dipakai, 0); // biar gak minus
    }


    //Method hitung sisa kamar
     public function getSisaKamarAttribute()
    {
    // contoh: jumlah_kamar - booking aktif
    //return $this->jumlah_kamar - $this->bookings()->count();
    return $this->jumlah_kamar;
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
