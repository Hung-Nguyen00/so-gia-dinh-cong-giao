<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoanCaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doan_ca', function (Blueprint $table) {
            $table->id();
            $table->string('ten_doan_ca', 50)->nullable();
            $table->date('ngay_bon_mang')->nullable();
            $table->unsignedBigInteger('ten_thanh_id')->index();

            $table->foreign('ten_thanh_id')->references('id')->on('ten_thanh')->onDelete('cascade');
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
        Schema::dropIfExists('doan_ca');
    }
}
