<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Payment;
use App\Services\DonationService;
use App\Services\Payment\PayPalService;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class PayController extends Controller
{
    /**
     * @param  Request  $request
     * @param  DonationService  $donationService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function paid(Request $request, DonationService $donationService)
    {
        try {
            $token = $request->get('token');
            $payerId = $request->get('PayerID');
            $paymentId = $request->get('paymentId');

            if (!$token || !$payerId || !$paymentId) {
                throw new InternalErrorException('Incorrect params.');
            }

            $payment = Payment::getByToken($token);

            if ('pending' !== $payment->status) {
                return redirect()->route('thank-you');
            }

            /** @var PayPalService $paymentService */
            $paymentService = $donationService->getPaymentService($payment->donation);

            if ($payment->donation->recurring) {
                $paymentService->executePlan($token);
            }

            if (!$payment->donation->recurring) {
                $paymentService->executePayment($payment, $paymentId, $payerId);
            }
        } catch (\Exception $exception) {
            //redirect to failed page
        }

        return redirect()->route('thank-you');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thankYou()
    {
        return view('thank_you');
    }

    public function testPdf(DonationService $donationService, $donation)
    {
        $donation = Donation::findOrFail($donation);

        [$path] = $donationService->generateCertificate($donation, false);

        return response()->download($path, 'certificate.pdf', ['Content-Type' => 'application/json']);
    }
}
