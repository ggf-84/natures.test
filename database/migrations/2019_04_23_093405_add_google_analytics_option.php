<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoogleAnalyticsOption extends Migration
{
    const GOOGLE_ANALYTICS = 'google_analytics';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $code = <<<CODE
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MLP8MMT');</script>
<!-- End Google Tag Manager -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MLP8MMT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
CODE;

        options_create(static::GOOGLE_ANALYTICS, $code, 'Analytics');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        options_remove(static::GOOGLE_ANALYTICS);
    }
}
