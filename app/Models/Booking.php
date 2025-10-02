<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking_kos';
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'id_user', 
        'id_kos', 
        'id_kamar', 
        'harga', 
        'lama_sewa',
        'tanggal_masuk',
        'jumlah_penghuni',
        'catatan',
        'status_pembayaran', 
        'bukti_tf', 
        'status_sewa'
    ];

    protected $attributes = [
    'status_pembayaran' => 'belum dibayar',
    'status_sewa' => 'menunggu',
    ];


     // Accessor untuk tanggal_keluar otomatis
    public function getTanggalKeluarAttribute()
    {
        return Carbon::parse($this->tanggal_masuk)->addMonths($this->lama_sewa);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi ke Kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id_kamar');
    }

    // Relasi ke Kosan (langsung, bukan lewat kamar)
   public function kosan()
    {
    return $this->belongsTo(Kosan::class, 'id_kos', 'id_kos');
    }

    public function kost()
    {
    return $this->belongsTo(Kosan::class, 'id_kos', 'id_kos');
    }

}
