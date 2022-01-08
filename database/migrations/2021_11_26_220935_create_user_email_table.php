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

            $table->string('status', 10)->nullable();

            $table->foreignId('mail_id')->nullable()
                ->constrained('email')->onDelete('cascade');
            $table->foreignId('create_by')->nullable()
                ->constrained('users')->onDelete('cascade');
            $table->foreignId('send_to')->nullable()
                ->constrained('users')->onDelete('cascade');

            $table->index(['mail_id', 'create_by']);
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
