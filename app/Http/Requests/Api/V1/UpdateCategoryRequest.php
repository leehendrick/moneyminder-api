<?php

namespace App\Http\Requests\Api\V1;


class UpdateCategoryRequest extends BaseCategoryRequest
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
            'data.attributes.name' => 'sometimes|string|max:100',
            'data.attributes.monthly_limit' => 'sometimes|string|min:0',
            'data.attributes.is_default' => 'sometimes|boolean',
            'data.relationships.author.data.id' => 'sometimes|integer|exists:users,id',
        ];
    }
}
