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
        Schema::table('booking_kos', function (Blueprint $table) {
            //
            $table->integer('lama_sewa')->default(1)->after('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_kos', function (Blueprint $table) {
            //
            $table->dropColumn('lama_sewa');
        });
    }
};
