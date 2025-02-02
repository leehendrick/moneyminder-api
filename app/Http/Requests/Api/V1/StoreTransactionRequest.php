<?php

namespace App\Http\Requests\Api\V1;

use App\Permissions\V1\Abilities;
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

        $userIdAttr = $this->routeIs('transactions.store') ? 'data.relationships.author.data.id' : 'user';

        $rules = [
            //TODO: Usar regex para value
            'data.attributes.value' => 'required|string',
            'data.attributes.date' => 'required|date_format:Y-m-d',
            'data.attributes.description' => 'required|string',
             $userIdAttr => 'required|integer|exists:users,id',
        ];

        $user = $this->user();

        if ($user->tokenCan(Abilities::CreateOwnTransaction)) {
            $rules[$userIdAttr] .= '|size:' . $user->id;
        }
        //TODO: Melhorar a validação e usar regex
        if ($this->routeIs('transactions.store')) {
            $rules ['data.relationships.transactionType.data.id'] = 'required|integer';
            $rules ['data.relationships.category.data.id'] = 'required|integer';
        }

        return $rules;
    }

    protected function prepareForValidation(): void {
        if ($this->routeIs('users.transactions.store')) {
            $this->merge([
                'user' => $this->route('user')
            ]);
        }
    }

}
