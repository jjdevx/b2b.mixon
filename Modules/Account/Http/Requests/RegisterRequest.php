<?php

namespace Modules\Account\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string255', 'min:2'],
            'surname' => ['required', 'string255', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'numbers', 'letters', 'same:passwordConfirmation'],
            'company' => ['nullable', 'string255', 'min:3'],
            'okpo' => ['nullable', 'numeric', 'min:6'],
            'country' => ['nullable', 'string255', 'min:3'],
            'city' => ['nullable', 'string255', 'min:2'],
            'address' => ['nullable', 'string255', 'min:10'],
            'fax' => ['nullable', 'string255', 'min:10'],
            'phone' => ['nullable', 'string255', 'min:10'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
