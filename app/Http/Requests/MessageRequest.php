<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [    
            'message' => 'required|string|max:255',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif|max:2048',
            'colocation_id' => 'required|exists:colocations,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
