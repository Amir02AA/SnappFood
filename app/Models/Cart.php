<?php

namespace App\Models;

use App\Classes\OrderStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'total_fee',
        'total_off',
        'total_fee_after_off'
    ];

    protected $fillable = [
        'user_id', 'restaurant_id',
        'address_id', 'off_code_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function food(): BelongsToMany
    {
        return $this->belongsToMany(Food::class)->withPivot('count');
    }

    public function scopeRelatedCart($query, $restaurantId): void
    {
        $query->where([
            'restaurant_id' => $restaurantId,
            'user_id' => Auth::id(),
        ]);
    }



    public function totalFee(): Attribute
    {
        return Attribute::make(
            get: fn() => $this?->food->sum(function ($food) {
                return $food->price * $food->pivot->count;
            })
        );
    }

    public function totalOff(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->food->sum(function (Food $food) {
                return ($food->final_percent / 100) * $food->price * $food->pivot->count;
            })
        );
    }

    public function totalFeeAfterOff(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->total_fee - $this->total_off) * (1 - $this->off_code?->percent/100)
        );
    }

    public function offCode()
    {
        return $this->belongsTo(OffCode::class);
    }

}
