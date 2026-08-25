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
        Schema::create('log_presensi_kelas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kelas');
            $table->date('tanggal');
            $table->integer('id_user')->nullable(); // the piket who confirmed it
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
        Schema::dropIfExists('log_presensi_kelas');
    }
};
