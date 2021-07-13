<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultCo2OptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('result_quiz_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('result_quiz_id')->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->string('main_title_block_1', 255)->nullable();
            $table->string('description_block_1', 255)->nullable();
            $table->string('main_title_block_2', 255)->nullable();
            $table->string('main_title_block_3', 255)->nullable();
            $table->string('description_block_3', 255)->nullable();
            $table->string('title_block_3_a', 255)->nullable();
            $table->string('description_block_3_a', 255)->nullable();
            $table->string('label_block_3_a', 255)->nullable();
            $table->string('title_block_3_b', 255)->nullable();
            $table->string('description_block_3_b', 255)->nullable();
            $table->string('label_block_3_b', 255)->nullable();
            $table->string('title_block_3_c', 255)->nullable();
            $table->string('description_block_3_c', 255)->nullable();
            $table->string('label_block_3_c', 255)->nullable();
            $table->string('title_block_3_d', 255)->nullable();
            $table->string('description_block_3_d', 255)->nullable();
            $table->string('label_block_3_d', 255)->nullable();

            $table->foreign('result_quiz_id')->references('id')->on('result_quizzes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_quiz_translations');
        Schema::dropIfExists('result_quizzes');
    }
}
