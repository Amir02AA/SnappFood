<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function food()
    {
        return $this->belongsTo(Food::class);
    }

    protected function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
