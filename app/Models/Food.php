<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = ['name', 'materials', 'price', 'food_tier_id', 'restaurant_id'];
    public $timestamps = false;
    use HasFactory;

    protected function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    protected function restaurant()
    {
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
        return $this->morphMany(Image::class, 'imageable');
    }

    protected function finalPercent(): Attribute
    {
        return Attribute::make(
            get: fn()=> max($this->off?->percent, $this->party?->percent)
        );
    }

    protected function finalPrice(): Attribute
    {
        $finalPercent = max($this->off?->percent, $this->party?->percent);
        return Attribute::make(
            get: fn() => $this->price *
                (1 - ($finalPercent / 100)),
        );
    }

    public function party()
    {
        return $this->hasOne(Party::class);
    }
}
