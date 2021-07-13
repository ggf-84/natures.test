<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/18/18
 * Time: 12:08
 */

namespace App\Services\Payment;

use App\Donation;

trait DataPaymentTrait
{
    public function preparePaymentData(Donation $donation)
    {
        return [
            'return_url' => route('finish-payment'),
            'cancel_url' => route('donation'),
            'recurring' => $this->recurringValue($donation->recurring),
            'amount' => $donation->amount,
            'currency' => options_find('paypal_currency', 'USD'),
            'description' => 'Plant a tree.',
        ];
    }

    private function recurringValue($recurring)
    {
        //WEEK, DAY, YEAR, MONTH
        return $recurring ? (Donation::RECURRING_MONTHLY == $recurring ? 'MONTH' : 'YEAR') : null;
    }
}
