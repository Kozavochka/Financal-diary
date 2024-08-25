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
                Rule::unique('cryptos','name')->ignore($this->route('crypto'))->withoutTrashed()
            ],
            'ticker' => [
                'required',
                'string',
                Rule::unique('cryptos','ticker')->ignore($this->route('crypto'))->withoutTrashed()
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
