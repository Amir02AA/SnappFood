<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $fillable = [
        'name', 'phone', 'account', 'opens_at', 'closes_at', 'is_open', 'user_id', 'send_cost'
    ];

//    public function isOpen()
//    {
//        return Attribute::make(
//            get: fn($value , $attributes) => ($value && now()->between(
//                Date::createFromTimeString($attributes['opens_at']),
//                Date::createFromTimeString($attributes['closes_at']),
//                ))
//        );
//    }
    public function tiers()
    {
        return $this->belongsToMany(RestaurantTier::class, 'restaurant_tier');
    }

    protected function user()
    {
        return $this->belongsTo(User::class);
    }

    public function food()
    {
        return $this->hasMany(Food::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    protected function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function foodTiers()
    {
        return $this->belongsToMany(FoodTier::class, 'food');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
