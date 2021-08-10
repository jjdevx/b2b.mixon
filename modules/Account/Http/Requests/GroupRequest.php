<?php

namespace Modules\Account\Http\Requests;

use App\Models\Department;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function rules(): array
    {
        $types = array_keys(Department::$types);

        return [
            'name' => ['required', 'string255']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
