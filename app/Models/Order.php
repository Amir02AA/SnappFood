<?php

namespace App\Models;

use App\Classes\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'restaurant_id',
        'paid_date', 'status',
        'address_id', 'off_code_id',
        'total_price', 'total_discount',
        'send_cost'
    ];
    protected $casts = [
        'status' => OrderStatus::class
    ];

    public function food(): BelongsToMany
    {
        return $this->belongsToMany(Food::class)->withPivot('count');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
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

}
