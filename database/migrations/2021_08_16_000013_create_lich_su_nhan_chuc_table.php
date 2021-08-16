<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLichSuNhanChucTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'lich_su_nhan_chuc';

    /**
     * Run the migrations.
     * @table lich_su_nhan_chuc
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->date('ngay_nhan_chuc')->nullable();
            $table->string('noi_nhan_chuc', 250)->nullable();
            $table->string('chuc_vu', 50)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('tu_si_id')->index();
            $table->unsignedBigInteger('nguoi_khoi_tao')->index();

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
