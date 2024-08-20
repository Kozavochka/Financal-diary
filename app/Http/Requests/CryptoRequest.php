<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class CryptoRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'ticker' => [
                'required',
                'string',
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'lots' => [
                'numeric',
                'required'
            ],
        ];
    }
}
