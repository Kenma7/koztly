<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah enum status_sewa, tambahin "menunggu"
        DB::statement("ALTER TABLE booking_kos MODIFY COLUMN status_sewa ENUM('menunggu','aktif','selesai','batal') DEFAULT 'menunggu'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Balikin ke enum awal tanpa 'menunggu'
        DB::statement("ALTER TABLE booking_kos MODIFY COLUMN status_sewa ENUM('aktif','selesai','batal') DEFAULT 'aktif'");
    }
};
