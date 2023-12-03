<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class RestaurantPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        return ($user->current_address)?
            Response::allow()
            :Response::deny('You must select an address');
    }
}
