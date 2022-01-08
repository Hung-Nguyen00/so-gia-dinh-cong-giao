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
            $table->string('ma_so', 20)->unique();
            $table->date('ngay_tao_so')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('nguoi_khoi_tao')->index();

            $table->foreignid('giao_xu_id')->nullable()
                ->constrained('giao_xu')
                ->onDelete('cascade');

            $table->index(['id', 'ma_so', 'giao_xu_id']);
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
