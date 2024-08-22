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
                Rule::unique('stocks','name')->ignore($this->route('stock'))->withoutTrashed(),
            ],
            'ticker' => [
                'required',
                'string',
                Rule::unique('stocks','ticker')->ignore($this->route('stock'))->withoutTrashed(),
            ],
            'price' => [
                'required',
                'numeric',
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
