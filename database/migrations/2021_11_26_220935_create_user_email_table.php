<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_email', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('create_by')->index()->nullable();
            $table->unsignedBigInteger('send_to')->index()->nullable();
            $table->unsignedBigInteger('mail_id')->index()->nullable();

            $table->string('status', 10)->nullable();

            $table->foreign('mail_id')->references('id')->on('mail')->onDelete('cascade');
            $table->foreign('create_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('send_to')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_email');
    }
}
