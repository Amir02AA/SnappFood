<?php

namespace App\Policies;

use App\Classes\OrderStatus;
use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function create(User $user, $cartId): bool
    {
        return $user->carts()->where([
            ['paid_date', '!=', null],
            ['status', '=', OrderStatus::Received]
        ])->doesntHave('comment')->get()->contains($cartId);
    }

    public function changeStatus(User $user, Comment $comment)
    {
        return $user->restaurant->carts()->has('comment')->get()->pluck('comment')->contains($comment);
    }

    public function viewFiltered(User $user, int $foodId)
    {
        return $user->restaurant?->food->contains($foodId);
    }
}
