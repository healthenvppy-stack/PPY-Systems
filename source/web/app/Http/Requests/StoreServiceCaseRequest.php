<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceCaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'citizen_id' => ['nullable', 'exists:citizens,id'],
            'module' => ['required', 'max:50'],
            'case_type' => ['required', 'max:100'],
            'priority' => ['required', 'in:normal,urgent,emergency'],
            'opened_at' => ['nullable', 'date'],
            'remark' => ['nullable'],
        ];
    }
}