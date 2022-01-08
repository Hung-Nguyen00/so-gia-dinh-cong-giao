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
            $table->string('noi_dien_ra', 50)->nullable();
            $table->string('linh_muc_ngoai', 50)->nullable();
            $table->string('ten_nguoi_do_dau', 45)->nullable();
            $table->string('ten_thanh_nguoi_do_dau', 30)->nullable();
            $table->date('ngay_sinh_nguoi_do_dau')->nullable();
            $table->string('ten_nguoi_lam_chung_1', 45)->nullable();
            $table->string('ten_thanh_nguoi_lam_chung_1', 30)->nullable();
            $table->date('ngay_sinh_nguoi_lam_chung_1')->nullable();
            $table->string('ten_nguoi_lam_chung_2', 45)->nullable();
            $table->string('ten_thanh_nguoi_lam_chung_2', 30)->nullable();
            $table->date('ngay_sinh_nguoi_lam_chung_2')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('nguoi_khoi_tao')->index();

            $table->foreignId('bi_tich_id')
                ->constrained('bi_tich')
                ->onDelete('cascade');

            $table->foreignId('thanh_vien_id')
                ->constrained('thanh_vien')
                ->onDelete('cascade');

            $table->foreignId('tu_si_id')->nullable()
                ->constrained('tu_si')
                ->onDelete('set null');

            $table->index(['bi_tich_id', 'thanh_vien_id', 'tu_si_id'], 'idx_btdn');
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