<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     *
     */
    public function toArray(Request $request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price'=> $this->price." T",
            'count' => $this->pivot->count,
            'party' => $this->when($this->party?->percent , $this->party?->percent." %")
        ];
    }
}
