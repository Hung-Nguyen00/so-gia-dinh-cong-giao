<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaoTinhTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'giao_tinh';

    /**
     * Run the migrations.
     * @table giao_tinh
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('ten_giao_tinh', 100)->nullable(false);
            $table->string('dia_chi', 150)->nullable();
            $table->string('ten_nha_tho')->nullable();
            $table->date('ngay_thanh_lap')->nullable();

            $table->unsignedBigInteger('nguoi_khoi_tao')->index();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
