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
        Schema::create('mst_siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('no_daftar',20);
            $table->string('nis',20);
            $table->string('nisn',20);
            $table->string('nama_lengkap',200);
            $table->enum('jk',['L','P']);
            $table->string('angkatan',10);
            $table->enum('jalur',['REGULER','PRESTASI','PINDAHAN']);
            $table->string('asal_sltp',300);
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
        Schema::dropIfExists('mst_siswa');
    }
};
