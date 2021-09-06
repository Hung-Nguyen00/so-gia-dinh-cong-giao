<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGiaoTinhToTuSiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tu_si', function (Blueprint $table) {
            $table->char('la_tong_giam_muc', 1)->nullable();
            $table->unsignedBigInteger('giao_tinh_id')->nullable()->index();

            $table->foreign('giao_tinh_id')
                ->references('id')
                ->on('giao_tinh')
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
