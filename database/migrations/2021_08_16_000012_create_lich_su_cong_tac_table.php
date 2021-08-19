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
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('tu_si_id')->index();



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
