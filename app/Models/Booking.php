<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
     use HasFactory;

    protected $fillable = [
        'id_kos',
        'nama',
        'no_hp',
        'tanggal_mulai',
        'lama_sewa',
    ];
}
