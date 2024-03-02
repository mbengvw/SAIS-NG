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
        Schema::create('mst_kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->integer('id_tahun');
            $table->integer('tahun');
            $table->string('jurusan');
            $table->integer('tingkat');
            $table->integer('paralel');
            $table->string('nama_kelas', 20);
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
        Schema::dropIfExists('mst_kelas');
    }
};
