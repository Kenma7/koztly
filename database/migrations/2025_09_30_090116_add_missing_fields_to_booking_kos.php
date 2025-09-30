<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tidak pakai if condition, langsung add
        Schema::table('booking_kos', function (Blueprint $table) {
            $table->date('tanggal_masuk')->after('lama_sewa');
            $table->integer('jumlah_penghuni')->default(1)->after('tanggal_masuk');
            $table->text('catatan')->nullable()->after('jumlah_penghuni');
        });
    }

    public function down(): void
    {
        Schema::table('booking_kos', function (Blueprint $table) {
            $table->dropColumn(['catatan', 'jumlah_penghuni', 'tanggal_masuk']);
        });
    }
};