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

            $table->foreignId('quyen_quan_tri_id')
                ->constrained('quyen_quan_tri')
                ->onDelete('cascade');

            $table->foreignId('giao_phan_id')->nullable()
                ->constrained('giao_phan')
                ->onDelete('cascade');

            $table->foreignId('giao_xu_id')->nullable()
                ->constrained('giao_xu')
                ->onDelete('cascade');

            $table->index(['id', 'giao_xu_id', 'giao_phan_id', 'quyen_quan_tri_id'],
                'idx_user');
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
