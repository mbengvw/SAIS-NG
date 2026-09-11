<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trx_catatan_pembelajaran', function (Blueprint $table) {
            $table->enum('status_kehadiran', ['H', 'S', 'I', 'A', 'D'])->default('H')->after('id_siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trx_catatan_pembelajaran', function (Blueprint $table) {
            $table->dropColumn('status_kehadiran');
        });
    }
};
