<?php

namespace App\Http\Resources\restaurant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->day->name => [
                'opens_at' => $this->start_time,
                'closes_at' => $this->end_time,
            ]
        ];
    }
}
