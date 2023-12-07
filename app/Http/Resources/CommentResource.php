<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'author' => $this->user->name,
            'food' => $this->order?->food->pluck('name'),
            'score' => $this->score,
            'content' => $this->content,
            'answer' => $this->when($this->replied,$this->replied?->content),
            'commented_at' => $this->created_at
        ];
    }
}
