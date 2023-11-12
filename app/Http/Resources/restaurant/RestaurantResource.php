<?php

namespace App\Http\Resources\restaurant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'restaurant name' => $this->name,
            'type' => $this->tiers,
            'address' => $this->address,
            'is_open' => $this->is_open
        ];
    }
}
