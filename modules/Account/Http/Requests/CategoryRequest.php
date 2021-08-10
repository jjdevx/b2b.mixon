<?php

namespace Modules\Account\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'groupId' => ['required', 'exists:goods_groups,id'],
            'name' => ['required', 'string255'],
            'number' => ['required', 'integer']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
