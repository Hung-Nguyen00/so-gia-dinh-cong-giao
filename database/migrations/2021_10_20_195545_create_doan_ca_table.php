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

            $table->foreignId('ten_thanh_id')
                ->constrained('ten_thanh')->onDelete('cascade');

            $table->index(['ten_thanh_id']);
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
