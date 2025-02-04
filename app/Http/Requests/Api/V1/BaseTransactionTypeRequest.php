<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseTransactionTypeRequest extends FormRequest
{

    public function mappedAttributes(array $otherAttributes = []): array
    {
        $attributeMap = array_merge([
            'data.attributes.name' => 'name',
        ], $otherAttributes);

        $attributesToUpdate = [];

        foreach ($attributeMap as $key => $attribute) {
            if ($this->has($key)) {

                $value = $this->input($key);
                $attributesToUpdate[$attribute] = $value;
            }
        }

        return $attributesToUpdate;
    }

    public function messages(): array
    {
        return  [
            'MSG' => 'MSG',
        ];
    }
}
