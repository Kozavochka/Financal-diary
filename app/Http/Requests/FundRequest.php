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
                Rule::unique('funds','name')->ignore($this->route('fund'))->withoutTrashed()
            ],
            'ticker' => [
                'string',
                'required',
                Rule::unique('funds','ticker')->ignore($this->route('fund'))->withoutTrashed()
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
