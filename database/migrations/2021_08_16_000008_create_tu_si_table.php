<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTuSiTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tu_si';

    /**
     * Run the migrations.
     * @table tu_si
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('ho_va_ten', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->date('ngay_mat')->nullable();
            $table->date('bat_dau_phuc_vu')->nullable();
            $table->date('ket_thuc_phuc_vu')->nullable();
            $table->string('dia_chi_hien_tai', 100)->nullable();
            $table->string('so_dien_thoai', 11)->nullable();
            $table->date('ngay_nhan_chuc')->nullable();
            $table->string('noi_nhan_chuc', 100)->nullable();
            $table->boolean('dang_du_hoc')->nullable();
            $table->char('la_tong_giam_muc', 1)->nullable();
            $table->boolean('gioi_tinh');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('nguoi_khoi_tao')->index();

            $table->foreignId('chuc_vu_id')->nullable()
                ->constrained('chuc_vu')
                ->onDelete('cascade');

            $table->foreignId('giao_phan_id')->nullable()
                ->constrained('giao_phan')
                ->onDelete('cascade');

            $table->foreignId('giao_hat_id')->nullable()
                ->constrained('giao_hat')
                ->onDelete('cascade');

            $table->foreignId('giao_xu_id')->nullable()
                ->constrained('giao_xu')
                ->onDelete('set null');
            $table->foreignId('vi_tri_id')
                ->constrained('vi_tri')
                ->onDelete('cascade');

            $table->index(
                ['chuc_vu_id',
                    'giao_phan_id',
                    'giao_hat_id',
                    'giao_xu_id',
                    'vi_tri_id'], 'idx_tu_si');
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
