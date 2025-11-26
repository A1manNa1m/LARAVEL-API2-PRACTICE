<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'customer_id' => 'required|exists:customers,id',
                'invoice_id' => 'required|exists:invoices,id',
                'amount' => 'required|numeric|min:1',
                'payment_method' => 'required|string|in:CC,DC,PP,FPX,cc,dc,fpx',
                'payment_date' => 'required|date format:Y-m-d H:i:s',
            ];
        } else{
            return [
                'customer_id' => 'sometimes|required|exists:customers,id',
                'invoice_id' => 'sometimes|required|exists:invoices,id',
                'amount' => 'sometimes|required|numeric|min:1',
                'payment_method' => 'sometimes|required|string|in:CC,DC,PP,FPX,cc,dc,fpx',
                'payment_date' => 'sometimes|required|date format:Y-m-d H:i:s',
            ];
        }
    }
}
