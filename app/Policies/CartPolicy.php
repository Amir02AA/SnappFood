<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\User;

class CartPolicy
{
    /**
     * Create a new policy instance.
     */
    public function pay(User $user)
    {
        return $user->currentAddress;
    }

    public function view(User $user, Cart $cart)
    {
        return $user->carts->contains($cart);
    }
}
