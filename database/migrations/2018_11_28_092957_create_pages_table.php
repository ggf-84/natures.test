<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active');
            $table->string('key', 255)->nullable();
            $table->string('type')->nullable();
            $table->string('admin_title')->nullable();
            $table->timestamps();
        });

        Schema::create('page_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id')->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('body')->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->string('slug', 255)->nullable();

            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('page_elements', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id')->nullable();
            $table->string('key', 150)->nullable();
            $table->string('image_file_name')->nullable();
            $table->integer('image_file_size')->nullable();
            $table->string('image_content_type')->nullable();
            $table->timestamp('image_updated_at')->nullable();
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade')->onUpdate('cascade');
            $table->index(['page_id', 'key']);
        });

        Schema::create('page_element_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_element_id')->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->text('content')->nullable();

            $table->foreign('page_element_id')->references('id')->on('page_elements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
        });

        $seeder = new PagesTableSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_element_translations');
        Schema::dropIfExists('page_elements');
        Schema::dropIfExists('page_translations');
        Schema::dropIfExists('pages');
    }
}
