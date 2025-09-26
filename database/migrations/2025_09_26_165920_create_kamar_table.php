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
        Schema::create('kamar', function (Blueprint $table) {
            $table->id('id_kamar');
            $table->unsignedBigInteger('id_kos');
             $table->string('nomor_kamar');
            $table->enum('status', ['tersedia', 'dibooking'])->default('tersedia');
            $table->timestamps();

            $table->foreign('id_kos')->references('id_kos')->on('kosan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
