<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'categories',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                $this->mergeWhen($request->routeIs('categories.*'),[
                    'monthly_limit' => $this->monthly_limit,
                    'is_default' => $this->is_default,
                    'createdAt' => $this->created_at,
                    'updatedAt' => $this->updated_at,
                ])
            ],
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
            'includes' => [
                new UserResource($this->user)
            ],
            'links' => [
                [
                    'self' => route('categories.show', ['categories' => $this->id])
                ]
            ],
        ];
    }
}
