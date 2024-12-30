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
        $attributeMap = [
            'data.attributes.value' => 'value',
            'data.attributes.date' => 'date',
            'data.attributes.description' => 'description',
            'data.relationships.transactionType.data.id' => 'transaction_type_id',
            'data.relationships.category.data.id' => 'category_id',
            'data.relationships.author.data.id' => 'user_id',
        ];

        $attributesToUpdate = [];
        foreach ($attributeMap as $key => $attribute) {
            if ($this->has($key)) {
                $attributesToUpdate[$attribute] = $this->input($key);
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
