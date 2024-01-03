<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoanRequest extends FormRequest
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
                'required',
                'string',
            ],
            'price' => [
                'numeric',
                'required',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
            'count_bus' => [
                'numeric',
                'nullable',
            ],
        ];
    }
}
