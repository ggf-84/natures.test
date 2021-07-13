<?php

namespace App\Presenters;

use Terranet\Presentable\Presenter;

class PaymentPresenter extends Presenter
{
    public function donationId()
    {
        $donation = $this->presentable->donation;

        if ($donation) {
            return '<a href="' . route('scaffold.view', ['donations', $donation->id]) . '">' . $donation->email . '</a>';
        }
    }
}
