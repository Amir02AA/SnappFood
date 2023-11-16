<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Food extends Model
{
    protected $fillable = ['name', 'price', 'food_tier_id', 'restaurant_id'];
    protected $appends = [
        'final_price',
        'final_percent'
    ];
    public $timestamps = false;
    use HasFactory;

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class)->withPivot('count');
    }

    protected function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    protected function foodTier(): BelongsTo
    {
        return $this->belongsTo(FoodTier::class);
    }

    protected function off(): HasOne
    {
        return $this->hasOne(OffFood::class);
    }

    protected function images(): MorphMany
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

    public function party(): HasOne
    {
        return $this->hasOne(Party::class);
    }

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }

}
