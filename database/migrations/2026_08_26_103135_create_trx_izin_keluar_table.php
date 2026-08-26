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
        Schema::create('trx_izin_keluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_kelas')->nullable(); // Helper
            $table->date('tanggal');
            $table->dateTime('waktu_keluar')->nullable();
            $table->dateTime('waktu_kembali')->nullable();
            $table->string('alasan');
            $table->unsignedBigInteger('id_guru_pemberi')->nullable();
            $table->unsignedBigInteger('id_user_piket_keluar')->nullable();
            $table->unsignedBigInteger('id_user_piket_kembali')->nullable();
            $table->boolean('is_pulang')->default(false);
            $table->enum('status', ['menunggu', 'keluar', 'kembali'])->default('menunggu');
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
        Schema::dropIfExists('trx_izin_keluar');
    }
};
