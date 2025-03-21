<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('bahanbakus', function (Blueprint $table) {
            $table->integer('nilai_x')->after('harga_total'); // Tambahkan kolom nilai_x
        });
    }

    public function down()
    {
        Schema::table('bahanbakus', function (Blueprint $table) {
            $table->dropColumn('nilai_x');
        });
    }
};
