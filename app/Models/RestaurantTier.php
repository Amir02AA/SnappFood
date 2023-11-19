<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantTier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_tier');
    }
}
