<?php

namespace Modules\Account\Http\Requests;

class ProfileRequest extends UserRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        unset($rules['shippingPoint'], $rules['saleType'], $rules['roles'], $rules['roles.*'], $rules['categories'], $rules['categories.*']);

        $rules['email'] = ['required', 'email', 'unique:users,email,' . \Auth::id()];
        $rules['password'] = ['nullable', 'string', 'min:8', 'numbers', 'letters'];

        return $rules;
    }
}
