<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('companies','name')->ignore($this->route('company'))
            ],
            'inn' => [
                'nullable',
                'string',
                'max:14'
            ],
            'ogrn' => [
                'nullable',
                'string',
                'max:256'
            ]
        ];
    }
}
