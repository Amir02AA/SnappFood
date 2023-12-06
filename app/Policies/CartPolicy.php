<?php

namespace App\Policies;

use App\Classes\UserHelper;
use App\Models\Cart;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CartPolicy
{
    /**
     * Create a new policy instance.
     */
    public function create(User $user , int $foodId)
    {
        if (!$user->current_address)
            return Response::deny('You must select an address');
        $nearRestaurantsFood = UserHelper::getNearRestaurantsQuery()->get()->map(function (Restaurant $restaurant){
            return $restaurant->food;
        })->flatten();
        if ($nearRestaurantsFood->doesntContains($foodId))
            return Response::deny("You can't order From This Restaurant");
        return Response::allow();
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
