<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoGiaDinhCongGiaoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'so_gia_dinh_cong_giao';

    /**
     * Run the migrations.
     * @table so_gia_dinh_cong_giao
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('ma_so', 15)->unique();
            $table->date('ngay_tao_so')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('nguoi_khoi_tao')->index();
            $table->unsignedBigInteger('giao_xu_id')->index();

            $table->foreign('giao_xu_id')
                ->references('id')->on('giao_xu')
                ->onDelete('cascade');
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
