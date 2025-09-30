<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KamarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_kos' => \App\Models\Kosan::inRandomOrder()->first()->id_kos ?? \App\Models\Kosan::factory(),
            'nomor_kamar' => $this->faker->unique()->bothify('?##'),
            'status' => $this->faker->randomElement(['tersedia', 'tersedia', 'tersedia', 'dibooking']),
            // 75% tersedia, 25% dibooking
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}