<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    public function create(User $user , $cartId): bool
    {
        return $user->carts->where('paid_date','!=',null)->contains($cartId);
    }
}
