<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    public function create(User $user , $cartId): bool
    {
        $cart = Cart::find($cartId);
        return $user->carts->where('paid_date','!=',null)->contains($cartId) && !$cart->comment;
    }

    public function changeStatus(User $user,Comment $comment)
    {
        return $user->restaurant->carts()->has('comment')->get()->pluck('comment')->contains($comment);
    }
}
