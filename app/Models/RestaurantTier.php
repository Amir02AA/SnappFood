<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTier extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected function restaurants()
    {
        return $this->belongsToMany(Restaurant::class,'tier_restaurant');
    }
}
