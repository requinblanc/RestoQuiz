<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_question_answer', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('option_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('question_id')->constrained();
            //$table->unsignedBigInteger('user_id');
            $table->tinyInteger('is_right');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_question_answer');
    }
};
