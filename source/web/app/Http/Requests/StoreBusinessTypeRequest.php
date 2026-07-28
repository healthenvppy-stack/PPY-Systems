<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBusinessTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'business_category_id' => [
                'required',
                'integer',
                'exists:business_categories,id',
            ],

            'code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('business_types', 'code'),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'legal_reference' => [
                'nullable',
                'string',
                'max:500',
            ],

            'requires_license' => [
                'nullable',
                'boolean',
            ],

            'license_fee' => [
                'nullable',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],

            'license_validity_months' => [
                'nullable',
                'integer',
                'min:1',
                'max:120',
            ],

            'inspection_interval_months' => [
                'nullable',
                'integer',
                'min:1',
                'max:120',
            ],

            'risk_level' => [
                'required',
                Rule::in([
                    'ต่ำ',
                    'ปานกลาง',
                    'สูง',
                ]),
            ],

            'application_form' => [
                'nullable',
                'string',
                'max:255',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ];
    }
}