<?php

namespace Modules\Account\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        $billing = implode(',', array_keys(Order::$billing));
        $types = implode(',', array_keys(Order::$types));

        return [
            'billing' => ['required', "in:$billing"],
            'type' => ['required', "in:$types"],
            'comment' => ['nullable', 'string255']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
