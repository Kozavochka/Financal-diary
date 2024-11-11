<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read array $settings
 */
class UpdateSettingsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'settings' => ['array', 'required'],
            'settings.*.key' => [
                'required',
                'string',
            ],
            'settings.*.value' => [
                'required'
            ]
        ];
    }
}
