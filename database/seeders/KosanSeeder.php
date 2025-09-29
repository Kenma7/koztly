<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kosan;

class KosanSeeder extends Seeder
{
    public function run(): void
    {
        Kosan::factory(10)->count(12)->create(); 
    }
}
