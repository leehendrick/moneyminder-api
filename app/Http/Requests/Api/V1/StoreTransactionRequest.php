<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;

class StoreTransactionRequest extends BaseTransactionRequest
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
            'data.attributes.value' => 'required|string',
            'data.attributes.date' => 'required|date_format:Y-m-d',
            'data.attributes.description' => 'required|string',
        ];

        if ($this->routeIs('transactions.store')) {
            $rules ['data.relationships.author.data.id'] = 'required|integer';
            $rules ['data.relationships.transactionType.data.id'] = 'required|integer';
            $rules ['data.relationships.category.data.id'] = 'required|integer';
        }

        return $rules;
    }

}
