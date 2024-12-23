<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'transaction_type',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                $this->mergeWhen($request->routeIs('transactionTypes.*'),[
                    'createdAt' => $this->created_at,
                    'updatedAt' => $this->updated_at,
                ])
            ],
            'links' => [
                [
                    'self' => route('transactionTypes.show', ['transactionTypes' => $this->id])
                ]
            ],
        ];
    }
}
