<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BondRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'ticker' => [
                'string',
                'required',
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'coupon' => [
                'numeric',
                'required',
            ],
            'coupon_percent' => [
                'numeric',
                'nullable',
            ],
            'profit_percent' => [
                'numeric',
                'nullable',
            ],
            'expiration_date' => [
                'date_format:Y-m-d',
                'nullable',
            ],
            'coupon_day_period' => [
                'date_format:Y-m-d',
                'nullable',
            ],
        ];
    }
}
