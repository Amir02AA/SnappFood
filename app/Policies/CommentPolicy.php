<?php

namespace App\Policies;

use App\Classes\OrderStatus;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    public function create(User $user, $orderId)
    {
        if ($user->orders()->where('status', OrderStatus::Received)
            ->doesntHave('comment')->get()->contains($orderId))
            return Response::allow();
        return Response::deny('You dont own this order',404);
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
