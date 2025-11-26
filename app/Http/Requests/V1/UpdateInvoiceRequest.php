<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
                'amount' => 'required|numeric|min:1',
                'status' => 'required|string|in:B,HP,FP,OP,V,b,hp,fp,op,v',
                'billed_date' => 'required|date format:Y-m-d H:i:s',
                'paid_date' => 'nullable|date format:Y-m-d H:i:s',
            ];
        } else{
            return [
                'customer_id' => 'sometimes|required|exists:customers,id',
                'amount' => 'sometimes|required|numeric|min:1',
                'status' => 'sometimes|required|string|in:B,HP,FP,OP,V,b,hp,fp,op,v',
                'billed_date' => 'sometimes|required|date format:Y-m-d H:i:s',
                'paid_date' => 'sometimes|nullable|date format:Y-m-d H:i:s',
            ];
        }
    }
}
