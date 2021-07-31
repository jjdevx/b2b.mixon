<?php

namespace Modules\Account\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'perPage' => ['nullable', 'int'],
            'searchQuery' => ['nullable', 'string'],
            'sortBy' => ['nullable', 'string'],
            'sortDesc' => ['nullable', 'bool']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
