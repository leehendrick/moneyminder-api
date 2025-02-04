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
                'monthly_limit' => $this->monthly_limit,
                'is_default' => $this->is_default,
                $this->mergeWhen($request->routeIs('categories.*'),[
                    'createdAt' => $this->created_at,
                    'updatedAt' => $this->updated_at,
                ])
            ],
            'relationships' => [
                'author' => [
                    'data' => [
                        'type' => 'user',
                        'id' => $this->user_id,
                    ],
                    'links' => [
                            'self' => route('users.show', ['user' => $this->user_id]),
                    ],
                ],
            ],
        ];
    }
}
