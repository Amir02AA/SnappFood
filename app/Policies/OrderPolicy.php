<?php

namespace App\Policies;

use App\Models\Food;
use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->restaurant->orders->contains($order);
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->restaurant->orders->contains($order);
    }

    public function changeStatus(User $user, Order $order): bool
    {
        return $user->restaurant->orders->contains($order);
    }
}
