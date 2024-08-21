<?php

namespace App\Http\Requests;

use App\Enums\LoanPaymentTypeEnum;
use App\Enums\LoanRepaymentScheduleTypeEnum;
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
            'company_id' => [
                'required',
                'integer',
                'exists:companies,id'
            ],
            'name' => [
                'required',
                'string',
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'percent' => [
                'numeric',
                'required',
            ],
            'repayment_schedule_type' => [
                'required',
                'string',
                Rule::in(LoanRepaymentScheduleTypeEnum::toLabels())
            ],
            'payment_type' => [
                'required',
                'string',
                Rule::in(LoanPaymentTypeEnum::toLabels())
            ],
            'expiration_date' => [
                'required',
                'date',
                'after_or_equal:now'
            ],
            'payment_day' => [
                'nullable',
                'integer'
            ],
        ];
    }
}
