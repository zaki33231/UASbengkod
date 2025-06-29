<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('daftar_polis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('poli_id');
            $table->unsignedBigInteger('jadwal_id');
            $table->text('keluhan');
            $table->integer('no_antrian');
            $table->enum('status', ['Menunggu', 'Diperiksa', 'Selesai', 'Batal'])->default('Menunggu');
            $table->timestamps();

            $table->foreign('pasien_id')->references('id')->on('pasiens')->onDelete('cascade');
            $table->foreign('poli_id')->references('id')->on('polis')->onDelete('cascade');
            $table->foreign('jadwal_id')->references('id')->on('jadwal_periksa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daftar_polis');
    }
};