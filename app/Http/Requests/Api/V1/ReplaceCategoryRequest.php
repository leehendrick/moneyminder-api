<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;

class ReplaceCategoryRequest extends BaseCategoryRequest
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
        $rules = [
            'data.attributes.name' => 'required|string|max:100',
            'data.attributes.monthly_limit' => 'required|string|min:0',
            'data.attributes.is_default' => 'required|boolean',
            'data.relationships.author.data.id' => 'required|integer|exists:users,id',
        ];

        return $rules;
    }

}
