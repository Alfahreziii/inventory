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
        Schema::create('bahanbakus', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_kadaluarsa');
            $table->date('tgl_masuk');
            $table->unsignedBigInteger('id_bahan');
            $table->foreign('id_bahan')->references('id')->on('namabahans')->onDelete('cascade');
            $table->integer('sisa');
            $table->integer('demand');
            $table->integer('biaya_simpan');
            $table->integer('biaya_pesan');
            $table->integer('harga_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahanbakus');
    }
};
