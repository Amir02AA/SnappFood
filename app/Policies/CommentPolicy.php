<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function create(User $user, $cartId): bool
    {
        return $user->carts->where('paid_date', '!=', null)->doesntHave('comment')->contains($cartId);
    }

    public function changeStatus(User $user, Comment $comment)
    {
        return $user->restaurant->carts()->has('comment')->get()->pluck('comment')->contains($comment);
    }

    public function viewFiltered(User $user, int $foodId)
    {
        return $user->restaurant?->food()->contains($foodId);
    }
}
