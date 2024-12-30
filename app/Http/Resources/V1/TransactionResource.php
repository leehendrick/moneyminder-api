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
                'description' => $this->when(
                    !$request->routeIs(['transactions.show', 'users.transactions.index']),
                    $this->description
                ),
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
                            'self' => route('users.show', ['user' => $this->user_id]),
                        ]
                    ],
                ],
                'transactionType' => [
                    'data' => [
                        'type' => 'transactionType',
                        'id' => $this->transaction_type_id,
                    ]
                ],
                'category' => [
                    'data' => [
                        'type' => 'category',
                        'id' => $this->category_id,
                    ]
                ]
            ],
            'includes' => [
                new UserResource($this->whenLoaded('user')),
                //new TransactionTypeResource($this->transactionTypes), ---> Not returning the relationship
                //new CategoriesResource($this->categories), ---> Not returning the relationship
            ],
            'links' => [
                [
                    'self' => route('transactions.show', ['transaction' => $this->id])
                ]
            ],
        ];
    }
}
