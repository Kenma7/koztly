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
        Schema::create('booking_kos', function (Blueprint $table) {
            $table->id('id_booking');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kos');
            $table->unsignedBigInteger('id_kamar');
            $table->integer('harga');
            $table->enum('status_pembayaran', ['belum dibayar', 'sudah dibayar'])->default('belum dibayar');
            $table->string('bukti_tf')->nullable();
            $table->enum('status_sewa', ['aktif', 'selesai', 'batal'])->default('aktif');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kos')->references('id_kos')->on('kosan')->onDelete('cascade');
            $table->foreign('id_kamar')->references('id_kamar')->on('kamar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_kos');
    }
};
