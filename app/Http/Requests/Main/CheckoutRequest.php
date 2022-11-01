<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
            'phone' => 'nullable',
            'city_id' => 'required',
            'country_id' => 'required',
            'province_id' => 'required',
            'address' => 'required',
            'address_2' => 'required',
            'zipcode' => 'required',
            'email' => 'required|email'
        ];
    }
}
