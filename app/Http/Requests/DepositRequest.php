<?php

namespace App\Http\Requests;

use App\Enums\DepositTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepositRequest extends FormRequest
{

    public function rules()
    {
        return [
            'bank_id' => [
                'integer',
                'required',
                'exists:banks,id'
            ],
            'type' => [
              'string',
              'required',
              Rule::in(DepositTypeEnum::toLabels())
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'percent' => [
                'numeric',
                'required',
            ],
            'expiration_date' => [
                'date_format:Y-m-d',
                'nullable',
            ],
        ];
    }
}
