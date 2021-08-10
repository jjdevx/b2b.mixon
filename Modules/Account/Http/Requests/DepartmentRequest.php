<?php

namespace Modules\Account\Http\Requests;

use App\Models\Department;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        $types = array_keys(Department::$types);

        return [
            'name' => ['required', 'string255', 'min:4'],
            'type' => ['required', 'string', 'in:' . implode(',', $types)],
            'users' => ['array'],
            'users.*' => ['nullable', 'numeric', 'exists:users,id']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
