<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'status' => ['required', Rule::in(['sent', 'paid', 'cancelled'])],
            'amount' => ['required', 'numeric', 'min:0'],
            'billed_date' => ['required', 'date'],
            'paid_date' => ['nullable', 'date'],
        ];
    }
}
