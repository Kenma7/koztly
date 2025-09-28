<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kosan;

class KosanSeeder extends Seeder
{
    public function run(): void
    {
        Kosan::factory(10)->count(12)->create(); // kalau pakai factory

        // Atau manual dummy
        for ($i = 1; $i <= 12; $i++) {
            Kosan::create([
                'nama_kos' => 'Kosan '.$i,
                'lokasi_kos' => 'Jalan Dummy No.'.$i,
                'harga' => rand(500000, 1500000),
                'jumlah_kamar' => rand(5, 20),
                'fasilitas' => 'Wifi, AC, Parkir',
                'kategori' => ['pria', 'wanita', 'bebas'][array_rand(['pria', 'wanita', 'bebas'])],
                'status' => 'aktif',
                'gambar_kos' => null,
                'no_rek' => null,
            ]);
        }
    }
}
