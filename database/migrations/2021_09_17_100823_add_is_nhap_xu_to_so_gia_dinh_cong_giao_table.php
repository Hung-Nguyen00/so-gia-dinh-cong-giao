<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsNhapXuToSoGiaDinhCongGiaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('so_gia_dinh_cong_giao', function (Blueprint $table) {
            $table->boolean('la_nhap_xu')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('so_gia_dinh_cong_giao', function (Blueprint $table) {
            //
        });
    }
}
