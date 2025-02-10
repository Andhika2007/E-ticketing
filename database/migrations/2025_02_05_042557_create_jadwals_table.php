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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('no_penerbangan')->unique();
            $table->string('id_pesawat');  // Kolom Pesawat_id sebagai foreign key
            $table->string('keberangkatan');  // Kolom Keberangkatan sebagai foreign key
            $table->string('tujuan');  // Kolom Tujuan sebagai foreign key
            $table->foreign('id_pesawat')->references('id_pesawat')->on('maskapais'); // Menyesuaikan kolom id di pesawats
            $table->foreign('keberangkatan')->references('id_bandara')->on('bandaras'); // Menyesuaikan nama kolom pada tabel bandaras
            $table->foreign('tujuan')->references('id_bandara')->on('bandaras'); // Menyesuaikan nama kolom pada tabel bandaras
            $table->date('date');
            $table->time('boarding_time');
            $table->string('gerbang')->nullable();
            $table->integer('harga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
