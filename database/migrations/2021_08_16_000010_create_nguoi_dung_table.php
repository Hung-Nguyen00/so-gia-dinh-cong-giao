<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNguoiDungTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table nguoi_dung
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('ho_va_ten', 45)->nullable();
            $table->string('so_dien_thoai', 11)->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('quyen_quan_tri_id')->index();
            $table->unsignedBigInteger('giao_phan_id')->index();
            $table->unsignedBigInteger('giao_xu_id')->index()->nullable();

            $table->foreign('quyen_quan_tri_id')
                ->references('id')->on('quyen_quan_tri')
                ->onDelete('cascade');

            $table->foreign('giao_phan_id')
                ->references('id')->on('giao_phan')
                ->onDelete('cascade');

            $table->foreign('giao_xu_id')
                ->references('id')->on('giao_xu')
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
