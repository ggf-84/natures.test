<?php

namespace App\Http\Requests;

use App\Donation;
use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required:string',
            'email' => 'required|email',
            'type' => 'in:' . implode(',', array_keys(Donation::typesList())),
            'payment_type' => 'in:' . implode(',', Donation::paymentTypesList()),
            'country_id' => 'required|integer',
            'phone' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'terms' => 'required',
            'dedicate_type' => 'required_with:dedicated',
            'dedicate_name' => 'required_with:dedicated',
        ];
    }

    public function save()
    {
        $inputs = $this->except(['terms']);

        if (!isset($inputs['type'])) {
            $inputs['type'] = Donation::TYPE_PERSONAL;
        }

        if (!isset($inputs['payment_type'])) {
            $inputs['payment_type'] = Donation::PAYMENT_PAYPAL;
        }

        $donation = new Donation();
        $donation->fill($inputs);
        $donation->save();

        return $donation;
    }


}
