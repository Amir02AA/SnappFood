<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'restaurant' => $this->restaurant->name,
            'food' => FoodResource::collection($this->food),
            'total price' => $this->total_fee,
            'total off' => $this->total_off,
            'total price after off' => $this->total_fee_after_off,
            'paid_date' => $this->when($this->paid_date , $this->paid_date)
        ];
    }
}
