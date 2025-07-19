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
        Schema::table('namabahans', function (Blueprint $table) {
            $table->string('code_barang')->unique()->after('id'); // atau sesuaikan posisi kolom dengan after
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('namabahans', function (Blueprint $table) {
            $table->dropUnique(['code_barang']);
            $table->dropColumn('code_barang');
        });
    }
};

