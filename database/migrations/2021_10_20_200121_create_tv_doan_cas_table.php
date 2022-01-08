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

            $table->boolean('truong_doan')->default(0);
            $table->foreignId('thanh_vien_id')
                ->constrained('thanh_vien')
                ->onDelete('cascade');
            $table->foreignId('doan_ca_id')
                ->constrained('doan_ca')->onDelete('cascade');

            $table->timestamps();

            $table->index(['thanh_vien_id', 'doan_ca_id']);
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
