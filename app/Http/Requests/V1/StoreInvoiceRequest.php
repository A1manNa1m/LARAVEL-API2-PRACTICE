<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:B,FP,HP,OP,V,b,fp,hp,op,v',
            'billed_date' => 'required|date|date_format:d-m-Y',
            'paid_date' => 'nullable|date|after_or_equal:billed_date|date_format:d-m-Y',
        ];
    }
}
