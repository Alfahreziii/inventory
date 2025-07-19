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
            $table->string('no_hp_suplier')->nullable()->after('suplier'); // atau sesuaikan dengan posisi yang diinginkan
            $table->text('alamat_suplier')->nullable()->after('no_hp_suplier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('namabahans', function (Blueprint $table) {
            $table->dropColumn('no_hp_suplier');
            $table->dropColumn('alamat_suplier');
        });
    }
};
