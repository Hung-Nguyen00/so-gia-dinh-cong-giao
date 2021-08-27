<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdNhaDongToTuSiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tu_si', function (Blueprint $table) {
            $table->unsignedBigInteger('nha_dong_id')->index()->nullable();

            $table->foreign('nha_dong_id')
                ->references('id')
                ->on('nha_dong')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tu_si', function (Blueprint $table) {
            //
        });
    }
}
