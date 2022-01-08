<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGiaoXuToDoanCa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doan_ca', function (Blueprint $table) {
            $table->foreignId('giao_xu_id')->index()
                ->constrained('giao_xu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doan_ca', function (Blueprint $table) {
            //
        });
    }
}
