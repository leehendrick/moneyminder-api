<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BaseTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function mappedAttributes(): array
    {
        $attributesMap = [
            'data.attributes.value' => 'required|string',
            'data.attributes.date' => 'required|date_format:Y-m-d',
            'data.attributes.description' => 'required|string',
            'data.relationships.author.data.id' => 'required|integer',
            'data.relationships.transactionType.data.id' => 'required|integer',
            'data.relationships.category.data.id' => 'required|integer',
        ];

        $attributesToUpdate = [];
        foreach ($attributesMap as $key => $attribute) {
            if ($this->has($key)) {
                $attributesToUpdate[$key] = $this->input($key);
            }
        }

        return $attributesToUpdate;
    }

    public function messages(): array
    {
        return  [
            'data.attributes.date' => 'The provided date is invalid. Please use yyyy-mm-dd format.',
        ];
    }
}
