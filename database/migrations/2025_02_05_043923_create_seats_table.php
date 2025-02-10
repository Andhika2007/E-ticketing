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
        Schema::create('seats', function (Blueprint $table) {
            $table->id(); // Kolom ID
            $table->string('id_pesawat'); // Kolom ID untuk menghubungkan ke tabel pesawat
            $table->string('bangku_code')->unique();; // Kolom untuk menyimpan kode kursi (misalnya 1A, 1B, dst.)
            $table->timestamps();

            // Menambahkan foreign key constraint untuk menghubungkan pesawat dengan seats
            $table->foreign('id_pesawat')->references('id_pesawat')->on('maskapais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
