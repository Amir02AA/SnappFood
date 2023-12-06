<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Food;
use App\Models\User;
use App\Policies\AddressPolicy;
use App\Policies\CartPolicy;
use App\Policies\CommentPolicy;
use App\Policies\FoodPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Food::class => FoodPolicy::class,
        Comment::class => CommentPolicy::class,
        Cart::class => CartPolicy::class,
        Address::class => AddressPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('visit-site',function (User $user){
           return $user->restaurant;
        });
    }
}
