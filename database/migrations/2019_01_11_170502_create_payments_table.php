<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('donation_id');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'approved', 'failed', 'refunded', 'locked', 'unlocked'])
                ->default('pending');
            $table->dateTime('payment_date')->nullable();
            $table->string('payment_id', 255)->nullable();
            $table->string('payer_id', 255)->nullable();
            $table->string('token', 255)->nullable();
            $table->timestamps();

            $table->foreign('donation_id')->references('id')->on('donations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
