<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kosan;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        $kosans = Kosan::all();
        
        $kosans->each(function ($kosan) {
            // Cek apakah kosan sudah punya kamar
            $existingKamars = Kamar::where('id_kos', $kosan->id_kos)->get();
            
            if ($existingKamars->count() > 0) {
                // UPDATE existing kamar
                $this->updateExistingKamars($existingKamars, $kosan);
            } else {
                // BUAT baru jika belum ada kamar
                $this->createNewKamars($kosan);
            }
            
            $this->command->info("Processed kamar for: {$kosan->nama_kos}");
        });
    }
    
    private function updateExistingKamars($kamars, $kosan)
    {
        $counter = 1;
        
        $kamars->each(function ($kamar) use (&$counter, $kosan) {
            $status = ($counter <= $kosan->jumlah_kamar * 0.8) ? 'tersedia' : 'dibooking';
            
            $kamar->update([
                'nomor_kamar' => $counter,
                'status' => $status,
            ]);
            
            $counter++;
        });
    }
    
    private function createNewKamars($kosan)
    {
        $jumlahKamar = $kosan->jumlah_kamar;
        
        for ($i = 1; $i <= $jumlahKamar; $i++) {
            $status = (rand(1, 100) <= 80) ? 'tersedia' : 'dibooking';
            
            Kamar::create([
                'id_kos' => $kosan->id_kos,
                'nomor_kamar' => $i,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}