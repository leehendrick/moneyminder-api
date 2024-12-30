<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends BaseTransactionRequest
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
            'data.attributes.value' => 'sometimes|string',
            'data.attributes.date' => 'sometimes|date_format:Y-m-d',
            'data.attributes.description' => 'sometimes|string',
            'data.relationships.author.data.id' => 'sometimes|integer',
            'data.relationships.transactionType.data.id' => 'sometimes|integer',
            'data.relationships.category.data.id' => 'sometimes|integer',
        ];

        return $rules;
    }
}
