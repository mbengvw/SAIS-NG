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
        Schema::create('trx_pertemuan_guru_mapel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penetapan');
            $table->date('tanggal');
            $table->text('materi_pembelajaran')->nullable();
            $table->timestamps();
            
            // Optional foreign key to PenetapanGuruMapel table if it's named penetapan_guru_mapel
            // $table->foreign('id_penetapan')->references('id')->on('penetapan_guru_mapel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_pertemuan_guru_mapel');
    }
};
