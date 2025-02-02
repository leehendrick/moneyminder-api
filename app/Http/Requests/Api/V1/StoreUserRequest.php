<?php

namespace App\Http\Requests\Api\V1;


class StoreUserRequest extends BaseUserRequest
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
            'data.attributes.name' => 'required|string|max:255|min:3',
            'data.attributes.email' => 'required|string|email|unique:users,email',
            'data.attributes.password' => 'required|string|min:8|max:50|',
            'data.relationships.default_currency' => 'nullable|string|size:3',
            'data.relationships.is_notifiable' => 'nullable|boolean',
        ];
    }
}
