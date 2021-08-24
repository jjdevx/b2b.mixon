<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'excel' => ['required', 'file', 'mimes:xls,xlsx'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
