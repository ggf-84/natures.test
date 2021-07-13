<?php

namespace App\Http\Controllers;

use App\Country;
use App\Donation;
use App\Http\Requests\DonationRequest;
use App\Services\DonationService;
use App\Services\Payment\PayService;

class DonationController extends Controller
{
    public function index()
    {
        $payStatus = (new PayService)->paymentIsDisable();
        if ($payStatus) {
            return redirect('/');
        }

        $donationTypes = Donation::typesList();
        $paymentMethods = Donation::paymentTypesList();
        $dedicateTypes = Donation::dedicateTypesList();
        $countries = Country::getList();
        $defaultCountry = Country::getDefault();

        return view('donate', compact('donationTypes', 'paymentMethods', 'dedicateTypes', 'countries', 'defaultCountry'));
    }

    public function storage(DonationRequest $request, DonationService $donationService)
    {
        $donation = $request->save();

        if (!$donation) {
            return back()->withErrors(trans('forms.error_save'));
        }

        $paymentService = $donationService->getPaymentService($donation);

        try {
            return redirect($paymentService->getApprovalLink($donation));
        } catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }
}
