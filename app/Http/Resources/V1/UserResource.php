<?php

namespace App\Http\Resources\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */


    public function toArray(Request $request): array
    {
        return [
            'type' => 'user',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                'default_currency' => $this->default_currency,
                'is_notifiable' => $this->is_notifiable,
                $this->mergeWhen($request->routeIs('users.*'), [
                    'emailVerifiedAt' => $this->email_verified_at,
                    'createdAt' => $this->created_at,
                    'updatedAt' => $this->updated_at,
                ]),
            ],
            'includes' => TransactionResource::collection($this->whenLoaded('transactions')),
            'links' => [
                'self' => route('users.show', ['user' => $this->id])
            ]

        ];
    }
}
