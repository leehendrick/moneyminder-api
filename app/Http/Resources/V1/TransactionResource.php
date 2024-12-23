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
                'transactionType' => [
                    'data' => [
                        'type' => 'transactionType',
                        'id' => $this->transaction_type_id
                    ],
                    'links' => [
                        [
                            'self' => 'todo',
                        ]
                    ],
                ],
                'category' => [
                    'data' => [
                        'type' => 'category',
                        'id' => $this->category_id
                    ],
                    'links' => [
                        [
                            'self' => 'todo',
                        ]
                    ],
                ],
            ],
            'links' => [
                [
                    'self' => route('transaction.show', ['transaction' => $this->id])
                ]
            ],
        ];
    }
}
