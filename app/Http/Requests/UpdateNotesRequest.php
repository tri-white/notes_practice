<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotesRequest extends FormRequest
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
        $rules = [
            'text' => 'required|string|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'text.required' => 'Note cannot be empty',
            'text.string'  => 'Note cannot contain any data except of characters',
            'text.max'  => 'Note cannot be longer than 5000 characters long!',
        ];
    }
}
