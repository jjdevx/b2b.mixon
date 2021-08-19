<?php

namespace Modules\Account\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        $update = request()->isMethod('PATCH');

        return [
            'avatar' => ['nullable', 'image', 'max:5096', 'mimes:jpg,jpeg,bmp,png'],
            'name' => ['required', 'string255', 'min:2'],
            'surname' => ['required', 'string255', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email,' . ($update ? $this->route()->parameter('user') : '')],
            'password' => [$update ? 'nullable' : 'required', 'string', 'min:8', 'numbers', 'letters'],
            'company' => ['nullable', 'string255', 'min:3'],
            'okpo' => ['nullable', 'numeric', 'min:6'],
            'country' => ['nullable', 'string255', 'min:3'],
            'city' => ['nullable', 'string255', 'min:2'],
            'address' => ['nullable', 'string255', 'min:10'],
            'fax' => ['nullable', 'string255', 'min:10'],
            'phone' => ['nullable', 'string255', 'min:10'],
            'shippingPoint' => ['nullable', 'exists:departments,id'],
            'roles' => ['array', 'nullable'],
            'roles.*' => ['nullable', 'numeric', 'exists:user_roles,id'],
            'categories' => ['array', 'nullable'],
            'categories.*' => ['nullable', 'numeric', 'exists:goods_categories,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
