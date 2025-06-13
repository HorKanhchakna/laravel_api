<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    return [
        'name' => ['required'],
        'email' => ['required', 'email'],
        'type' => ['required', Rule::in(['I', 'B', 'i', 'b'])],
        'address' => ['required'],
        'city' => ['required'],
        'state' => ['required'],
        'postal_code' => ['required'],
    ];
}

protected function prepareForValidation()
{
    if ($this->has('postalCode')) {
        $this->merge([
            'postal_code' => $this->postalCode
        ]);
    }
}

}
