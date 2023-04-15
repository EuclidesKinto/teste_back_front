<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class BudgetStoreRequest extends FormRequest
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
     *'client', 'description', 'price', 'seller_id'
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'client' => 'required|string|max:255',
            'price' => 'required|decimal:0,2|lt:1000',
            'description' => 'required|string|max:255',
            'seller_id' => 'required',
        ];
    }
}
