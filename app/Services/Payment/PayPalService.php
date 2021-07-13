<?php

namespace App\Services\Payment;

use App\Donation;
use App\Events\ClientNotification;
use Carbon\Carbon;
use function localizer\locale;
use PayPal\Api\Agreement;
use PayPal\Api\Amount;
use PayPal\Api\Currency;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Plan;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class PayPalService implements PaymentInterface
{
    use DataPaymentTrait;

    protected $apiContext;

    public function __construct()
    {
        $this->apiContext = $this->getApiContext();
    }

    public function getApprovalLink(Donation $donation)
    {
        if ($donation->recurring) {
            $this->getApprovalLinkRecurring($donation);
        }

        return $this->getApprovalLinkPayment($donation);
    }

    public function executePayment(\App\Payment $payment, $paymentId, $payerID)
    {
        $payPalPayment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerID);

        $result = $payPalPayment->execute($execution, $this->apiContext);

        $payment->payment_date = Carbon::now();
        $payment->payment_id = $paymentId;
        $payment->payer_id = $payerID;
        $payment->status = $result && in_array(
            $result->state,
            \App\Payment::availableStatuses()
        ) ? $result->state : 'failed';
        $payment->save();

        if ('approved' == $payment->status) {
            event(new ClientNotification($payment->donation, locale()->iso6391()));
        }
    }

    private function getApprovalLinkPayment(Donation $donation)
    {
        try {
            $data = $this->preparePaymentData($donation);

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $amount = new Amount();
            $amount->setCurrency($data['currency'])
                ->setTotal($data['amount']);

            $item = new Item();
            $item->setName($data['description'])
                ->setCurrency($data['currency'])
                ->setQuantity(1)
                ->setSku($donation->id)
                ->setPrice($data['amount']);

            $itemList = new ItemList();
            $itemList->setItems([$item]);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription($data['description'])
                ->setInvoiceNumber($donation->id);

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl($data['return_url'])
                ->setCancelUrl($data['cancel_url']);

            $payment = new Payment();
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

            $payment->create($this->apiContext);

            $donationPayment = new \App\Payment();
            $donationPayment->fill([
                'donation_id' => $donation->id,
                'token' => $payment->getToken(),
                'amount' => $donation->amount,
            ]);
            $donationPayment->save();

            return $payment->getApprovalLink();
        } catch (\Exception $exception) {
            throw new InternalErrorException($exception->getMessage());
        }
    }

    public function executePlan($token)
    {
        $agreement = new Agreement();
        try {
            $agreement->execute($token, $this->apiContext);
        } catch (\Exception $exception) {
            throw new InternalErrorException($exception->getMessage());
        }
    }

    private function getApprovalLinkRecurring(Donation $donation)
    {
        try {
            $data = $this->preparePaymentData($donation);

            $createdPlan = $this->updatePlan($this->createPlan($data));

            $plan = new Plan();
            $plan->setId($createdPlan->getId());

            $agreement = new Agreement();

            $agreement->setName('Plant a tree')
                ->setDescription('You help us reforest the planet.')
                ->setStartDate(Carbon::tomorrow()->toAtomString());

            $agreement->setPlan($plan);
            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
            $agreement->setPayer($payer);

            $agreement = $agreement->create($this->apiContext);

            $agreement->getApprovalLink();
            $donation->saveToken($agreement->getAgreementDetails()->to);

            return $agreement->getApprovalLink();
        } catch (\Exception $exception) {
            throw new InternalErrorException($exception->getMessage());
        }
    }

    private function createPlan($data): Plan
    {
        try {
            $plan = new Plan();
            $plan->setName('Recurring Donation')
                ->setDescription($data['description'])
                ->setType('INFINITE');

            $currency = new Currency([
                'value' => $data['amount'],
                'currency' => $data['currency'],
            ]);

            $paymentDefinition = new PaymentDefinition();
            $paymentDefinition->setName('Plant a tree')
                ->setType('REGULAR')
                ->setFrequency($data['recurring'])
                ->setFrequencyInterval("1")
                ->setCycles("0")
                ->setAmount($currency);

            $merchantPreferences = new MerchantPreferences();
            $merchantPreferences->setReturnUrl($data['return_url'])
                ->setCancelUrl($data['cancel_url'])
                ->setAutoBillAmount("YES")
                ->setInitialFailAmountAction("CONTINUE")
                ->setMaxFailAttempts("0")
                ->setSetupFee($currency);

            $plan->setPaymentDefinitions([$paymentDefinition]);
            $plan->setMerchantPreferences($merchantPreferences);

            return $plan->create($this->apiContext);
        } catch (\Exception $exception) {
            throw new InternalErrorException($exception->getMessage());
        }
    }

    private function updatePlan(Plan $createdPlan): Plan
    {
        try {
            $patch = new Patch();

            $value = new PayPalModel('{"state":"ACTIVE"}');

            $patch->setOp('replace')
                ->setPath('/')
                ->setValue($value);
            $patchRequest = new PatchRequest();
            $patchRequest->addPatch($patch);

            $createdPlan->update($patchRequest, $this->apiContext);

            return Plan::get($createdPlan->getId(), $this->apiContext);
        } catch (\Exception $exception) {
            throw new InternalErrorException($exception->getMessage());
        }
    }

    public function getPlans()
    {
        $params = ['page_size' => '2'];

        return Plan::all($params, $this->apiContext);
    }

    private function getApiContext()
    {
        $payPalType = options_find('paypal_type');

        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                options_find('paypal_'.$payPalType.'_api_client_id'),
                options_find('paypal_'.$payPalType.'_api_client_secret')
            )
        );

        $apiContext->setConfig(
            [
                'mode' => options_find('paypal_type', 'sandbox'),
                'log.LogEnabled' => true,
                'log.FileName' => storage_path('logs/paypal.log'),
                'log.LogLevel' => config("payment.paypal.{$payPalType}.log_level"),
                'cache.enabled' => false,
                //'cache.FileName' => '/PaypalCache' // for determining paypal cache directory
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
            ]
        );

        return $apiContext;
    }
}
