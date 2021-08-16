<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViTriTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'vi_tri';

    /**
     * Run the migrations.
     * @table vi_tri
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('ten_vi_tri', 45)->nullable(false);
            $table->unsignedBigInteger('nguoi_khoi_tao')->index();
            $table->timestamps();
            $table->softDeletes();

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
