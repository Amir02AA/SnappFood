<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = ['name' , 'materials' , 'price' ,'food_tier_id','restaurant_id'];
    public $timestamps = false;
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

    protected function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }
}
