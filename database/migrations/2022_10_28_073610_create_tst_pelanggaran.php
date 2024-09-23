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
        Schema::create('tst_pelanggaran', function (Blueprint $table) {
            $table->id('id_pelanggaran');
            $table->bigInteger('id_hukdis');
            $table->bigInteger('id_grouping');
            $table->date('tanggal');
            $table->tinyInteger('semester');
            $table->integer('id_petugas');
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
        Schema::dropIfExists('tst_pelanggaran');
    }
};
