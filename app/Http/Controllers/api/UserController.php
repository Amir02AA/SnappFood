<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __invoke(UpdateUserRequest $request)
    {
        Auth::user()->update($request->validated());
        return response()->json([
            'massage' => 'user data updated',
            'new information' => new UserResource(Auth::user())
            ]
        );
    }
}
