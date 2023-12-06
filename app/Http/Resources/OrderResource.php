<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_id' => $this->id,
            'restaurant' => $this->restaurant->name,
            'food' => FoodResource::collection($this->food),
            'total price' => $this->total_price,
            'total off' => $this->total_discount,
            'total price after off' => $this->total_price - $this->total_discount,
            'paid at' => $this->paid_date,
            'status' => $this->status->name
        ];
    }
}
