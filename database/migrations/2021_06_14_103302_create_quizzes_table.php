<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('quiz_page_attribute', ['transport', 'food', 'house', 'lifestyle']);
            $table->enum('quiz_type', ['progress', 'select', 'radio', 'input','switch','checkbox','text']);
            $table->enum('unit_measure', ['kwh', 'hours', 'miles', 'mpg', 'tones', 'cars']);
            $table->integer('parent_id');
            $table->integer('rank')->default(0);
            $table->decimal('formula_qty', 12,6)->nullable();
            $table->boolean('custom_field')->default(0);
            $table->boolean('custom_formula')->default(0);
            $table->boolean('active')->default(0);
            $table->enum('icon',['none','car','bus','electricity','food','gas','man','plane','wallet']);
        });

        Schema::create('quiz_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quiz_id')->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->string('question', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->text('label_question')->nullable();

            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('quiz_translations');
        Schema::dropIfExists('quizzes');
    }
}
