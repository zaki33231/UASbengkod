<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('periksa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daftar_poli_id');
            $table->dateTime('tgl_periksa')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('biaya_periksa')->nullable();
            $table->enum('status', ['Menunggu', 'Dalam Proses', 'Selesai', 'Batal'])->default('Menunggu');
            $table->timestamps();

            $table->foreign('daftar_poli_id')->references('id')->on('daftar_polis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periksa');
    }
};