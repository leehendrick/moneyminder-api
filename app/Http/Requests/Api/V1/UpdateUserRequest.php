<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends BaseUserRequest
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
            'data.attributes.name' => 'sometimes|string|max:255|min:3',
            'data.attributes.email' => 'sometimes|string|email|unique:users,email',
            'data.attributes.password' => 'sometimes|string|min:8|max:50|',
            'data.attributes.default_currency' => 'sometimes|string|size:3',
            'data.attributes.is_notifiable' => 'sometimes|boolean',
        ];
    }
}
