<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichSuChuyenSuSgdcgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lich_su_sgdcg', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('giao_xu_id')->index();
            $table->unsignedBigInteger('sgdcg_id')->index();

            $table->foreign('sgdcg_id')
                ->references('id')
                ->on('so_gia_dinh_cong_giao')->onDelete('cascade');
            $table->timestamps();
            $table->foreign('giao_xu_id')
                ->references('id')
                ->on('giao_xu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lich_su_chuyen_su_sgdcg');
    }
}
