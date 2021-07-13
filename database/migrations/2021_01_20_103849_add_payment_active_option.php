<?php

use Illuminate\Database\Migrations\Migration;

class AddPaymentActiveOption extends Migration
{
    const OPTION_KEY = 'pay_btn_disable';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        options_create(static::OPTION_KEY, '0', 'payment');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        options_remove(static::OPTION_KEY);
    }
}
