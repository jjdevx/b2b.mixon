<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderByCodesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'excel' => ['nullable', 'file', 'mimes:xls,xlsx'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
