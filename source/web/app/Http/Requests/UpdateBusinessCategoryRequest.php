<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBusinessCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $businessCategory = $this->route('business_category');

        return [
            'business_group_id' => [
                'required',
                'integer',
                'exists:business_groups,id',
            ],

            'code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('business_categories', 'code')
                    ->ignore($businessCategory?->id),
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