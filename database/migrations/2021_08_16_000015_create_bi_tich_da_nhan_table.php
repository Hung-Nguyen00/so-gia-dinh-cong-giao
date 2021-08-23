<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiTichDaNhanTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'bi_tich_da_nhan';

    /**
     * Run the migrations.
     * @table bi_tich_da_nhan
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->date('ngay_dien_ra')->nullable();
            $table->string('noi_dien_ra', 150)->nullable();
            $table->string('ten_nguoi_do_dau', 100)->nullable();
            $table->string('ten_thanh_nguoi_do_dau', 50)->nullable();
            $table->date('ngay_sinh_nguoi_do_dau')->nullable();
            $table->string('ten_nguoi_lam_chung_1', 100)->nullable();
            $table->string('ten_thanh_nguoi_lam_chung_1', 50)->nullable();
            $table->date('ngay_sinh_nguoi_lam_chung_1')->nullable();
            $table->string('ten_nguoi_lam_chung_2', 100)->nullable();
            $table->string('ten_thanh_nguoi_lam_chung_2', 50)->nullable();
            $table->date('ngay_sinh_nguoi_lam_chung_2')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('nguoi_khoi_tao')->index();
            $table->unsignedBigInteger('thanh_vien_id')->index();
            $table->unsignedBigInteger('bi_tich_id')->index();
            $table->unsignedBigInteger('tu_si_id')->index();


            $table->foreign('bi_tich_id')
                ->references('id')->on('bi_tich')
                ->onDelete('cascade');

            $table->foreign('thanh_vien_id')
                ->references('id')->on('thanh_vien')
                ->onDelete('cascade');

            $table->foreign('tu_si_id')
                ->references('id')->on('tu_si')
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