<?php

namespace App\Policies;

use App\Classes\OrderStatus;
use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function create(User $user, $cartId): bool
    {
        return $user->orders()->where('status', OrderStatus::Received)
            ->doesntHave('comment')->get()->contains($cartId);
    }

    public function changeStatus(User $user, Comment $comment)
    {
        return $user->restaurant->orders()->has('comment')->get()->pluck('comment')->contains($comment);
    }

    public function viewFiltered(User $user, int $foodId)
    {
        return $user->restaurant?->food->contains($foodId);
    }
}
