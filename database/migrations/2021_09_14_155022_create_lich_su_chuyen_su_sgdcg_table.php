<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichSuChuyenSuSgdcgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lich_su_sgdcg', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sgdcg_id')
                ->constrained('so_gia_dinh_cong_giao')->onDelete('cascade');
            $table->foreignId('giao_xu_id')
                ->constrained('giao_xu')->onDelete('cascade');

            $table->timestamps();
            $table->index(['giao_xu_id', 'sgdcg_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lich_su_chuyen_su_sgdcg');
    }
}
