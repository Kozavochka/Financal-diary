<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IncomeRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'income_type_id' => [
                Rule::exists('income_types','id'),
                'integer',
                'required',
            ],
            'price' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'cash_id' => [
                'integer',
                'required',
                'exists:cashes,id'
            ]
        ];
    }
}
