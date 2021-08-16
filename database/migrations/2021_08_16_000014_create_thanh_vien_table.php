<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThanhVienTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'thanh_vien';

    /**
     * Run the migrations.
     * @table thanh_vien
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('ho_va_ten', 100)->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->date('ngay_mat')->nullable();
            $table->string('dia_chi_hien_tai', 250)->nullable();
            $table->string('so_dien_thoai', 11)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('so_gia_dinh_id')->index();
            $table->unsignedBigInteger('ten_thanh_id')->index();
            $table->unsignedBigInteger('nguoi_khoi_tao')->index();

            $table->foreign('so_gia_dinh_id')
                ->references('id')->on('so_gia_dinh_cong_giao')
                ->onDelete('cascade');

            $table->foreign('ten_thanh_id')
                ->references('id')->on('ten_thanh')
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
