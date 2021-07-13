<?php

namespace App\Composers;

use App\Services\Payment\PayService;
use Illuminate\View\View;

class PayConfigurationComposer
{
    /** @var bool */
    protected $paymentBtnDisable = false;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->paymentBtnDisable = (new PayService)->paymentIsDisable();
    }
}
