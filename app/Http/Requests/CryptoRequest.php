<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                'string',
            ],
            'price' => [
                'required',
            ],
            'lots' => [
                'nullable'
            ],
            'direction_id' => [
                'integer',
                Rule::exists('directions', 'id'),
            ],
        ];
    }
}
