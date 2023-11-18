<?php

namespace App\Models;

use App\Classes\OrderStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;
    protected $appends = [
        'total_fee'
    ];
    protected $casts = [
        'status' => OrderStatus::class
    ];

    protected $fillable = ['user_id', 'restaurant_id', 'paid_date', 'status'];

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
            'paid_date' => null
        ]);
    }

    public function comment()
    {
        return $this->hasOne(Comment::class);
    }

    public function nextStep()
    {
        if ($this->status !== OrderStatus::Received) {
            $this->update([
                'status' => $this->status->value + 1
            ]);
        }
        return $this->status;
    }

    public function totalFee(): Attribute
    {
//        return $this?->food->map(function ($food) {
//            return $food->price * $food->pivot->count;
//        })->sum();
        return Attribute::make(
            get: fn() => $this?->food->sum(function ($food) {
                return $food->price * $food->pivot->count;
            })
        );
    }
}
