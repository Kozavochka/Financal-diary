<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
{

    public function rules()
    {
        return [
            'bank_name' => [
                'string',
                'required',
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'percent' => [
                'numeric',
                'required',
            ],
            'expiration_date' => [
                'date_format:Y-m-d',
                'nullable',
            ],
        ];
    }
}
