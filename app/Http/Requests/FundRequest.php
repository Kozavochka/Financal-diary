<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FundRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
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
            'lots' => [
                'numeric',
                'required'
            ]
        ];
    }
}
