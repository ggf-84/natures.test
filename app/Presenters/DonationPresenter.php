<?php

namespace App\Presenters;

use Terranet\Presentable\Presenter;

class DonationPresenter extends Presenter
{
    public function countryId()
    {
        return with($country = $this->presentable->country) ? $country->name : null;
    }

    public function adminType()
    {
        return $this->type ? trans('donations.types.' . $this->type) : null;
    }

    public function adminRecurring()
    {
        return $this->recurring ? trans('donations.payment.' . $this->recurring) : null;
    }

    public function adminPaymentType()
    {
        return $this->payment_type ? trans('donations.payment.' . $this->payment_type) : null;
    }

    public function adminDedicateType()
    {
        return $this->dedicate_type ? trans('donations.dedicate.' . $this->dedicate_type) : null;
    }
}
