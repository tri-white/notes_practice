<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Elegant\Sanitizer\Sanitizer;
use Elegant\Sanitizer\Filters\Enum;
use Elegant\Sanitizer\Laravel\SanitizesInput;
class StoreNotesRequest extends FormRequest
{
    use SanitizesInput;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    public function filters()
    {
        return [
            'text'=>'trim',
        ];
    }

    public function rules(): array
    {
        $rules = [
            'text' => 'required|string|max:5000',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'text.required' => 'Note cannot be empty',
            'text.string'  => 'Note cannot contain any data except of characters',
            'text.max'  => 'Note cannot be longer than 5000 characters long!',
            'user_id.required'  => 'A date must be after or equal today',
            'user_id.integer'  => 'This date doesn\'t exists',
            'user_id.exists'  => 'This date doesn\'t exists',
        ];
    }
}
