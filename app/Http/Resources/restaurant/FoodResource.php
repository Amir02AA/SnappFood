<?php

namespace App\Http\Resources\restaurant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            'name' => $this->name,
            'price'=> $this->price ." t",
             'off' => $this->final_percent . " %",
            'price after off' => $this->final_price. " t",
            'materials' =>  MaterialResource::collection($this->materials)
        ];
    }
}
