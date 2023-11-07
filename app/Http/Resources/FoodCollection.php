<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\returnArgument;

class FoodCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return FoodResource::collection($this->collection)->collection->filter(
            fn($value) => !($value->toJson() === '[]')
        )->toArray();
    }
}
