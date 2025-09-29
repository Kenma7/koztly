<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kosan>
 */
class KosanFactory extends Factory
{
    protected $model = \App\Models\Kosan::class;
    public function definition(): array
    {
        return [
            'nama_kos' => $this->faker->company . ' Kos',
            'lokasi_kos' => $this->faker->address,
            'harga' => $this->faker->numberBetween(500000, 2000000),
            'jumlah_kamar' => $this->faker->numberBetween(5, 20),
            'fasilitas' =>  json_encode($this->faker->randomElements(['wifi','ac','parkir','tv','laundry'], 3)),
            'kategori' => $this->faker->randomElement(['pria', 'wanita', 'bebas']),
            'status' => 'aktif',
            'gambar_kos' => 'https://picsum.photos/800/400?random=' . $this->faker->numberBetween(1,1000),
            'no_rek' => $this->faker->bankAccountNumber,
        ];
    }
}
