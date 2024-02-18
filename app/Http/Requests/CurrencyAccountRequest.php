<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyAccountRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'sum' => [
                'numeric',
                'required',
            ],
            'comment' => [
                'string',
                'nullable',
            ],
            'currency_type_id' => [
                'numeric',
                'required',
            ]
        ];
    }
}
