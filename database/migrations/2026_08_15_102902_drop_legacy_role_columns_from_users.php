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
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'admin')) {
                $table->dropColumn('admin');
            }
            if (Schema::hasColumn('users', 'piket')) {
                $table->dropColumn('piket');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('admin')->default(0)->nullable();
            $table->tinyInteger('piket')->default(0)->nullable();
        });
    }
};
