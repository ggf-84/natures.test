<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MovePaymentCredentialsToDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        options_create('paypal_type', 'sandbox', 'payment');
        options_create('paypal_sandbox_api_client_id',
            'Ae6huaazxXCQYrp0Co_sJBXnjBDz66_NyGCf4Df0H32uvLSe3ykEjI8G1ITKSH2PXohKgLvXh4AmHygK', 'payment');
        options_create('paypal_sandbox_api_client_secret',
            'EFGeXi6IVL_ZLDkZ6bug26OvPr5UE2eNT5xSSYpnVipFi4WDV2yxXHAtzd3OelyJqkR-_alBKUwj8cDM', 'payment');
        options_create('paypal_live_api_client_id', '', 'payment');
        options_create('paypal_live_api_client_secret', '', 'payment');
        options_create('paypal_currency', 'USD', 'payment');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        collect([
            'paypal_type',
            'paypal_sandbox_api_client_id',
            'paypal_sandbox_api_client_secret',
            'paypal_live_api_client_id',
            'paypal_live_api_client_secret',
            'paypal_currency',
        ])->each(function ($key) {
            options_remove($key);
        });
    }
}
