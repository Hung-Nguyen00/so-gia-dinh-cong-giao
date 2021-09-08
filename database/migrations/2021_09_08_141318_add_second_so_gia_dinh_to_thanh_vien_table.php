<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSecondSoGiaDinhToThanhVienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thanh_vien', function (Blueprint $table) {
            $table->unsignedBigInteger('so_gia_dinh_id_2')->index()->nullable();

            $table->foreign('so_gia_dinh_id_2')
                ->references('id')->on('so_gia_dinh_cong_giao')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thanh_vien', function (Blueprint $table) {
            //
        });
    }
}
