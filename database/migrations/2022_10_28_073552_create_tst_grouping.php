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
        Schema::create('tst_grouping', function (Blueprint $table) {
            $table->id('id_grouping');
            $table->bigInteger('id_siswa');
            $table->bigInteger('id_kelas');
            $table->string('tahun_akademik',10);
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
        Schema::dropIfExists('tst_grouping');
    }
};
