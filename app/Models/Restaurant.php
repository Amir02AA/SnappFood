<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Restaurant extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name' , 'phone' , 'address' ,'account' , 'opens_at' , 'closes_at' , 'is_open' , 'user_id'
    ];

    public function isOpen()
    {
        return Attribute::make(
            get: fn($value , $attributes) => ($value && now()->between(
                Date::createFromTimeString($attributes['opens_at']),
                Date::createFromTimeString($attributes['closes_at']),
                ))
        );
    }
    protected function tires()
    {
        return $this->belongsToMany(RestaurantTier::class,'tier_restaurant');
    }

    protected function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function food()
    {
        return $this->hasMany(Food::class);
    }

    protected function orders()
    {
        return $this->hasMany(Order::class);
    }
    protected function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }
}
