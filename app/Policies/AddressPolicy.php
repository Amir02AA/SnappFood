<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class AddressPolicy
{
    public function setCurrent(User $user, Address $address)
    {
        if ($address->addressable->isNot(Auth::user()))
            return Response::deny('You cant select this address');
        return Response::allow();
    }
}
