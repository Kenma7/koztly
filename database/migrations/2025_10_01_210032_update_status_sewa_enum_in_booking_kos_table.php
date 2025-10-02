<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update enum column
        DB::statement("ALTER TABLE booking_kos MODIFY COLUMN status_sewa ENUM('menunggu','disetujui','aktif','selesai','batal') DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        // Rollback ke enum sebelumnya
        DB::statement("ALTER TABLE booking_kos MODIFY COLUMN status_sewa ENUM('menunggu','aktif','selesai','batal') DEFAULT 'menunggu'");
    }
};