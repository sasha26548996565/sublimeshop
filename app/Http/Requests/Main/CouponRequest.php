<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|exists:coupons,name'
        ];
    }
}
