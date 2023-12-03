<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CartPolicy
{
    /**
     * Create a new policy instance.
     */
    public function create(User $user)
    {
        return ($user->current_address) ?
            Response::allow()
            : Response::deny('You must select an address');
    }

    public function pay(User $user, Cart $cart)
    {
        return ($user->carts->contains($cart)) ?
            Response::allow()
            : Response::deny('You dont own the cart');
    }

    public function view(User $user, Cart $cart)
    {
        return ($user->carts->contains($cart)) ?
            Response::allow()
            : Response::deny('You dont own the cart');
    }
}
