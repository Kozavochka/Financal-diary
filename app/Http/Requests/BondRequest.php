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
                Rule::unique('bonds','name')->ignore($this->route('bond'))->withoutTrashed()
            ],
            'ticker' => [
                'string',
                'required',
                Rule::unique('bonds','ticker')->ignore($this->route('bond'))->withoutTrashed()
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'lots' => [
                'integer',
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
                'after_or_equal:now'
            ],
            'coupon_day_period' => [
                'integer',
                'nullable',
            ],
        ];
    }
}
