<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Kosan;
use App\Models\Kamar;
use App\Models\User;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada data kosan dan kamar dulu
        $kosan = Kosan::first();
        $kamar = Kamar::first();
        $user = User::first();

        if (!$kosan || !$kamar || !$user) {
            $this->command->error('Butuh data kosan, kamar, dan user dulu!');
            return;
        }

        // Data booking dummy dengan berbagai status
        $bookings = [
            [
                'id_user' => $user->id,
                'id_kos' => $kosan->id_kos,
                'id_kamar' => $kamar->id_kamar,
                'harga' => $kosan->harga * 1,
                'lama_sewa' => 1,
                'jumlah_penghuni' => 1,
                'catatan' => 'Membawa kulkas kecil',
                'status_pembayaran' => 'belum dibayar',
                'status_sewa' => 'menunggu',
            ],
            [
                'id_user' => $user->id,
                'id_kos' => $kosan->id_kos,
                'id_kamar' => $kamar->id_kamar,
                'harga' => $kosan->harga * 3,
                'lama_sewa' => 3,
                'jumlah_penghuni' => 2,
                'catatan' => 'Ada 2 orang, bawa motor',
                'status_pembayaran' => 'belum dibayar',
                'status_sewa' => 'disetujui',
            ],
            [
                'id_user' => $user->id,
                'id_kos' => $kosan->id_kos,
                'id_kamar' => $kamar->id_kamar,
                'harga' => $kosan->harga * 6,
                'lama_sewa' => 6,
                'jumlah_penghuni' => 1,
                'catatan' => null,
                'status_pembayaran' => 'sudah dibayar',
                'status_sewa' => 'aktif',
            ],
            [
                'id_user' => $user->id,
                'id_kos' => $kosan->id_kos,
                'id_kamar' => $kamar->id_kamar,
                'harga' => $kosan->harga * 2,
                'lama_sewa' => 2,
                'jumlah_penghuni' => 1,
                'catatan' => 'Dibatalkan karena ada urusan',
                'status_pembayaran' => 'belum dibayar',
                'status_sewa' => 'batal',
            ],
        ];

        foreach ($bookings as $bookingData) {
            Booking::create($bookingData);
        }

        $this->command->info('Booking dummy created successfully!');
        $this->command->info('Booking IDs: ' . implode(', ', Booking::pluck('id_booking')->toArray()));
    }
}