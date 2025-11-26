<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest

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
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:customers,email,' . $this->customer->id,
                'type' => 'required|string|in:I,C,i,c',
                'address' => 'required|string|max:500',
                'city' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'postal_code' => 'required|string|max:20',
            ];
        } else{
            return [
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:customers,email,' . $this->customer->id,
                'type' => 'sometimes|required|string|in:I,C,i,c',
                'address' => 'sometimes|required|string|max:500',
                'city' => 'sometimes|required|string|max:100',
                'state' => 'sometimes|required|string|max:100',
                'postal_code' => 'sometimes|required|string|max:20',
            ];
        }
    }
}
