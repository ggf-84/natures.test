<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->unsignedInteger('country_id');
            $table->string('city', 150)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('email', 150);
            $table->string('phone', 150)->nullable();
            $table->text('comment')->nullable();
            $table->enum('type', ['personal', 'corporate']);

            $table->enum('payment_type', ['paypal', 'bitcoin']);
            $table->decimal('amount', 10, 2);
            $table->integer('trees')->default(0);
            $table->enum('recurring', ['monthly', 'yearly'])->nullable();

            $table->boolean('dedicated')->default(0);
            $table->enum('dedicate_type', ['in_honor', 'in_memory'])->nullable();
            $table->string('dedicate_name', 200)->nullable();
            $table->text('dedicate_message')->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')
                ->on('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
