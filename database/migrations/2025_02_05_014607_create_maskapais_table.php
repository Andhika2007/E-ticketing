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
        Schema::create('maskapais', function (Blueprint $table) {
            $table->id();
            $table->string('id_pesawat')->unique();
            $table->string('nama_maskapai');
            $table->string('nama_pesawat');
            $table->string('jenis_pesawat');
            $table->integer('jumlah_kursi');
            $table->integer('kursi_perbaris');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maskapais');
    }
};
