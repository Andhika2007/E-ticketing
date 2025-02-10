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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->string('no_pemesanan')->unique();
            $table->string('no_penerbangan');
            $table->string('bangku_code');
            $table->integer('jumlah_penumpang');
            $table->string('pembayaran');
            $table->string('bukti_pembayaran');
            $table->string('status_pesanan')->default('Pending');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->foreign('no_penerbangan')->references('no_penerbangan')->on('jadwal');
            $table->foreign('bangku_code')->references('bangku_code')->on('seats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
