<?php

namespace App\Http\Requests\Api;

use App\Traits\RequestJsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
{
    use RequestJsonResponse;

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
            'email' => 'required|email',
        ];
    }
}
