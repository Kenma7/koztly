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
        Schema::create('kosan', function (Blueprint $table) {
            $table->id('id_kos');
            $table->string('nama_kos');
            $table->string('lokasi_kos');
            $table->integer('harga');
            $table->integer('jumlah_kamar');
            $table->text('fasilitas');
            $table->enum('kategori', ['wanita', 'pria', 'bebas'])->default('bebas');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('gambar_kos')->nullable(); // path gambar (nullable)
            $table->string('no_rek')->nullable(); // nomor rekening bisa kosong dulu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosan');
    }
};
