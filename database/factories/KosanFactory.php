<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kosan>
 */
class KosanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_kos' => $this->faker->company . ' Kos',
            'lokasi_kos' => $this->faker->address,
            'harga' => $this->faker->numberBetween(500000, 2000000),
            'jumlah_kamar' => $this->faker->numberBetween(5, 20),
            'fasilitas' => 'WiFi, AC, Parkir, TV',
            'kategori' => $this->faker->randomElement(['pria', 'wanita', 'bebas']),
            'status' => 'aktif',
            'gambar_kos' => null, // bisa nanti isi dummy image
            'no_rek' => $this->faker->bankAccountNumber,
        ];
    }
}
