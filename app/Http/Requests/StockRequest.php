<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockRequest extends FormRequest
{


    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                Rule::unique('stocks')->ignore($this->route('stock')),
            ],
            'ticker' => [
                'string'
            ],
            'price' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'industry_id' => [
                'integer',
                Rule::exists('industries', 'id'),

            ],
            'lots' => [
                'numeric',
                'max:100000'
            ],

        ];
    }
}
