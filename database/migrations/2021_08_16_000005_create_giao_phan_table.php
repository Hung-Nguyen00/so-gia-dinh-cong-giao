<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaoPhanTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'giao_phan';

    /**
     * Run the migrations.
     * @table giao_phan
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('ten_giao_phan', 100)->nullable();
            $table->string('dia_chi', 250)->nullable();
            $table->string('ten_nha_tho', 100)->nullable();
            $table->date('ngay_thanh_lap')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('nguoi_khoi_tao')->index();
            $table->unsignedBigInteger('giao_tinh_id')->index();

            $table->foreign('giao_tinh_id')
                ->references('id')->on('giao_tinh')
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
