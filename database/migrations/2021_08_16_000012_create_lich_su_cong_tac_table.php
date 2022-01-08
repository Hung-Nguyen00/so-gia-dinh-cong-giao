<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLichSuCongTacTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'lich_su_cong_tac';

    /**
     * Run the migrations.
     * @table lich_su_cong_tac
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('ten_giao_phan', 45)->nullable();
            $table->string('ten_giao_hat', 45)->nullable();
            $table->string('ten_giao_xu', 45)->nullable();
            $table->string('ten_giao_ho', 45)->nullable();
            $table->date('bat_dau_phuc_vu')->nullable();
            $table->date('ket_thuc_phuc_vu')->nullable();
            $table->string('ten_vi_tri', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('tu_si_id')
                ->constrained('tu_si')
                ->onDelete('cascade');

            $table->index(['id', 'tu_si_id'], 'idx_lsct');
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
