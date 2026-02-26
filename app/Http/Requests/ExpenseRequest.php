<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
        return [
            'colocation_id' => 'required|exists:colocations,id',
            'title' => 'required|string|max:255|min:3',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:1',
            'payer_id' => 'required|exists:users,id',
            'split_with' => 'required|array|min:1',
            'split_with.*' => 'exists:users,id',
        ];
    }
}
