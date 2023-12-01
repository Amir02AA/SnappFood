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
            'food' => $this->cart->food->pluck('name'),
            'content' => $this->content,
            'commented_at' => $this->created_at
        ];
    }
}
