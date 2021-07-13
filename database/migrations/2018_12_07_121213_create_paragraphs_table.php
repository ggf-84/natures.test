<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParagraphsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paragraphs', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['faq', 'privacy-policy', 'terms-ofs-service']);
            $table->unsignedTinyInteger('rank')->default(0);
            $table->boolean('active');
        });

        Schema::create('paragraph_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('paragraph_id')->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();

            $table->foreign('paragraph_id')->references('id')->on('paragraphs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('paragraph_translations');
        Schema::dropIfExists('paragraphs');
    }
}
