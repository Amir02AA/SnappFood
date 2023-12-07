<?php

namespace App\Classes;

use App\Models\Food;
use Illuminate\Database\Eloquent\Collection;

class CommentHelper
{
    public static function getCommentsByFoodId(int $foodId)
    {
        $comments = Food::find($foodId)->orders()->has('comment')->get()->pluck('comment')->sortByDesc('created_at');
        return new Collection($comments);
    }
}
