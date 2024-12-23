<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'transaction',
            'id' => $this->id,
            'attributes' => [
                'value' => $this->value,
                'date' => $this->date,
                'description' => $this->description,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'relationships' => [
                'author' => [
                    'data' => [
                        'type' => 'user',
                        'id' => $this->user_id
                    ],
                    'links' => [
                        [
                            'self' => 'todo',
                        ]
                    ],
                ],
            ],
            'includes' => [
                new UserResource($this->user),
                new TransactionTypeResource($this->transactionTypes),
                new CategoriesResource($this->categories),
            ],
            'links' => [
                [
                    'self' => route('transactions.show', ['transaction' => $this->id])
                ]
            ],
        ];
    }
}
