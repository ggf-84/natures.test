<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/10/18
 * Time: 11:38
 */

namespace App\Services\Payment;

use App\Donation;

interface PaymentInterface
{
    public function getApprovalLink(Donation $donation);
}
