<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRecordRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => [
                'string',
                'nullable'
            ],
            'stocks' => 'required|array',//Массив акций
            'stocks.*.stock_id' => 'required|integer',//Массив id
            'stocks.*.price' => 'required|numeric',//Массив соотв. цены
        ];
    }
}
