<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                'nullable',
            ],
            'price' => [
                'numeric',
                'required',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
            'coupon' => [
                'numeric',
                'required',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'profit_percent' => [
                'numeric',
                'required',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
            'expiration_date' => [
                'date_format:Y-m-d',
                'nullable',
            ]
        ];
    }
}
