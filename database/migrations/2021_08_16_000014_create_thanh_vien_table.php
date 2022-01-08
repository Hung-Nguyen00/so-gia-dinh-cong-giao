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
            $table->string('ho_va_ten', 50)->nullable();
            $table->string('chuc_vu_gd', 10)->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->date('ngay_mat')->nullable();
            $table->string('dia_chi_hien_tai', 100)->nullable();
            $table->string('so_dien_thoai', 11)->nullable();
            $table->string('giao_xu', 25)->nullable();
            $table->string('giao_phan', 25)->nullable();
            $table->string('noi_sinh', 50)->nullable();
            $table->string('chuc_vu_gd_2', 5)->nullable();
            $table->boolean('gioi_tinh');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('nguoi_khoi_tao')->index();

            $table->foreignId('so_gia_dinh_id')
                ->constrained('so_gia_dinh_cong_giao')
                ->onDelete('cascade');
            $table->foreignId('so_gia_dinh_id_2')->nullable()
                ->constrained('so_gia_dinh_cong_giao')->onDelete('cascade');
            $table->foreignId('ten_thanh_id')
                ->constrained('ten_thanh')
                ->onDelete('cascade');

            $table->index(['so_gia_dinh_id',
                'so_gia_dinh_id_2',
                'ten_thanh_id',
                ], 'idx_sgd');

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
