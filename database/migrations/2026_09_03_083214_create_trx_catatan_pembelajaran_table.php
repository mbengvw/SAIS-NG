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
        Schema::create('trx_catatan_pembelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pertemuan');
            $table->string('id_siswa');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_pertemuan')->references('id')->on('trx_pertemuan_guru_mapel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_catatan_pembelajaran');
    }
};
