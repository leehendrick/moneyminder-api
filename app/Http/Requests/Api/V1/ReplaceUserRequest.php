<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReplaceUserRequest extends BaseUserRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'data.attributes.name' => 'required|string|max:255|min:3',
            'data.attributes.email' => 'required|string|email|unique:users,email',
            'data.attributes.password' => 'required|string|min:8|max:50|',
            'data.relationships.default_currency' => 'required|string|size:3',
            'data.relationships.is_notifiable' => 'required|boolean',
        ];

    }

}
