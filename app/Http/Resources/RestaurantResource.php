<?php

namespace App\Http\Resources;

use App\Http\Resources\restaurant\AddressResource;
use App\Http\Resources\restaurant\ScheduleResource;
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
            'id' => $this->id,
            'restaurant name' => $this->name,
            'type' => $this->tiers->pluck('name'),
            'address' => new AddressResource($this->address),
            'is_open' => $this->is_open,
            'schedule' => ScheduleResource::collection($this->schedules)
        ];
    }
}
