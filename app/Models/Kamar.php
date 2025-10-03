<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'id_kamar';

    protected $fillable = [
        'id_kos',
        'nomor_kamar',
        'harga',
        'status',
        
    ];

    // Relasi ke Kost (satu kamar milik satu kos)
    public function kosan(){
        return $this->belongsTo(Kosan::class, 'id_kos', 'id_kos');
    }


    // Relasi ke Booking (satu kamar dibooking berkali-kali)
    public function booking_kos(){
        return $this->hasMany(Booking::class, 'id_kamar'); 
    }
}
