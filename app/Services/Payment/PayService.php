<?php

namespace App\Services\Payment;

class PayService
{
    /**
     * @return bool
     */
    public function paymentIsDisable()
    {
        $paymentBtnDisable = options_find('pay_btn_disable');

        return isset($paymentBtnDisable) && filter_var($paymentBtnDisable, FILTER_VALIDATE_BOOLEAN);
    }
}
