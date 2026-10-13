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
        Schema::create('komponen_nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penetapan');
            $table->string('nama_komponen');
            $table->string('jenis')->default('tugas');
            $table->integer('bobot')->default(1);
            $table->integer('urutan')->default(1);
            $table->timestamps();

            $table->foreign('id_penetapan')->references('id')->on('penetapan_guru_mapel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komponen_nilai');
    }
};
