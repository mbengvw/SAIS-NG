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
        Schema::create('tst_kehadiran', function (Blueprint $table) {
            $table->id('id_kehadiran');
            $table->bigInteger('id_grouping');
            $table->integer('semester');
            $table->date('tanggal');
            $table->enum('status',['S','I','A']);
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tst_kehadiran');
    }
};
