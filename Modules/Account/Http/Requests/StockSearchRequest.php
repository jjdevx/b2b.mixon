<?php

namespace Modules\Account\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sku' => ['nullable', 'string255'],
            'name' => ['nullable', 'string255']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
