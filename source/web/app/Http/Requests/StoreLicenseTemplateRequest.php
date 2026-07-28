<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLicenseTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'business_type_id' => [
                'required',
                'integer',
                'exists:business_types,id',
            ],

            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('license_templates', 'code'),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'template_type' => [
                'required',
                Rule::in([
                    'NEW',
                    'RENEW',
                    'CHANGE',
                    'REPLACE',
                    'CANCEL',
                ]),
            ],

            'is_default' => [
                'nullable',
                'boolean',
            ],

            'application_form' => [
                'nullable',
                'string',
                'max:255',
            ],

            'fee_amount' => [
                'nullable',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],

            'validity_months' => [
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

            'approval_authority' => [
                'nullable',
                'string',
                'max:255',
            ],

            'legal_reference' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'effective_date' => [
                'nullable',
                'date',
            ],

            'expiry_date' => [
                'nullable',
                'date',
                'after_or_equal:effective_date',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'version' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ];
    }
}