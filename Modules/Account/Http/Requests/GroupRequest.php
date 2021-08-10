<?php

namespace Modules\Account\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string255']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
