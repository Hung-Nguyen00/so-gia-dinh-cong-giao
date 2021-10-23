<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvDoanCasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_doan_ca', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('thanh_vien_id')->index();
            $table->unsignedBigInteger('doan_ca_id')->index();

            $table->boolean('truong_doan')->default(0);
            $table->foreign('thanh_vien_id')->references('id')->on('thanh_vien')->onDelete('cascade');
            $table->foreign('doan_ca_id')->references('id')->on('doan_ca')->onDelete('cascade');


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
        Schema::dropIfExists('tv_doan_cas');
    }
}
