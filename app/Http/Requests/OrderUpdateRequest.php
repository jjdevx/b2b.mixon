<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ids' => ['required', 'array', 'exists:goods,id'],
            'goods' => ['required', 'array'],
            'goods.*' => ['required', 'integer', 'min:1']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['ids' => array_keys($this->input('goods'))]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
