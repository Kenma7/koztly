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
}
