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
        Schema::create('trx_mbg', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kelas');
            $table->date('tanggal');
            $table->integer('jumlah_hadir');
            $table->integer('jumlah_diambil')->nullable();
            $table->dateTime('waktu_diambil')->nullable();
            $table->string('nama_pengambil')->nullable();
            $table->integer('jumlah_kembali')->nullable();
            $table->dateTime('waktu_kembali')->nullable();
            $table->enum('status', ['belum', 'diambil', 'selesai'])->default('belum');
            $table->text('keterangan')->nullable();
            $table->integer('id_user_piket')->nullable();
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
        Schema::dropIfExists('trx_mbg');
    }
};
