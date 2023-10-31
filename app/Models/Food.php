<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    protected function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    protected function foodTier()
    {
        return $this->belongsTo(FoodTier::class);
    }

    protected function off()
    {
        return $this->hasOne(OffFood::class);
    }
}
