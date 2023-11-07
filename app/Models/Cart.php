<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'restaurant_id','paid_date'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function food()
    {
        return $this->belongsToMany(Food::class);
    }

    public function scopeRelatedCart($query , $restaurantId){
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
}
