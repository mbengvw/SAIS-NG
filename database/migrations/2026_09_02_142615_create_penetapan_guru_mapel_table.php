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
        Schema::create('penetapan_guru_mapel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tahun');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_guru');
            
            // Assuming the referenced tables have big integer IDs
            // Note: If some primary keys are normal integers, we might need to adjust, 
            // but Laravel 9+ defaults to big integer.
            $table->foreign('id_tahun')->references('id')->on('mst_tahun')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('mst_kelas')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id')->on('mst_mapel')->onDelete('cascade');
            $table->foreign('id_guru')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('penetapan_guru_mapel');
    }
};
