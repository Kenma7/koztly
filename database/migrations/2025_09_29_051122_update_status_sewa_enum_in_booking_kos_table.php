<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('booking_kos', function (Blueprint $table) {
            //menambah enum menunggu
            DB::statement("ALTER TABLE booking_kos MODIFY COLUMN status_sewa ENUM('aktif','selesai','batal','menunggu') DEFAULT 'menunggu'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_kos', function (Blueprint $table) {
            // Balikin ke enum lama
            DB::statement("ALTER TABLE booking_kos MODIFY COLUMN status_sewa ENUM('aktif','selesai','batal') DEFAULT 'aktif'");
        });
    }
};
