<?php

namespace App\Http\Terranet\Widgets;

use App\Donation;
use Terranet\Administrator\Contracts\Services\Widgetable;
use Terranet\Administrator\Services\Widgets\AbstractWidget;

class DonationPayments extends AbstractWidget implements Widgetable
{
    /**
     * @var Donation
     */
    private $donation;

    /**
     * DonationPayments constructor.
     *
     * @param Donation $donation
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Widget contents.
     *
     * @return mixed
     */
    public function render()
    {
        $payments = $this->donation->payments()->get();

        return view('admin.donations.payments', [
            'payments' => $payments,
        ]);
    }
}
