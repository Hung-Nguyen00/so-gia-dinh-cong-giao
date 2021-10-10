<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhaDongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nha_dong', function (Blueprint $table) {
            $table->id();
            $table->string('ten_nha_dong', 50);
            $table->string('dia_chi', 100);
            $table->date('ngay_thanh_lap')->nullable();
            $table->unsignedBigInteger('nguoi_khoi_tao')->index();

            $table->softDeletes();
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
        Schema::dropIfExists('nha_dongs');
    }
}
