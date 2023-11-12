<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowCommentsRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Food;
use App\Models\Restaurant;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        return \response()->json([
            'comment' => Comment::create($validated)
        ]);
    }

    public function index(ShowCommentsRequest $request)
    {

        if (!$request->validated('restaurant_id') & !$request->validated('food_id')) {
            return response()->json([
                'massage' => 'please enter a field to filter'
            ], 422);
        }
        ($request->missing('restaurant_id')) ?

            $comments = Food::find($request->validated('food_id'))
                ->carts()->with('comment')->getRelation('comment')->get()

            :$comments =Restaurant::find($request->validated('restaurant_id'))
                ->carts()->with('comment')->getRelation('comment')->get();
        return response()->json(['comments' => $comments]);
    }
}
