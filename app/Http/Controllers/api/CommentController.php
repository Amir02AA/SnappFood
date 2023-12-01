<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\ShowCommentsRequest;
use App\Http\Requests\api\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $this->authorize('create', [
            Comment::class, $request->validated('cart_id')
        ]);
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        return \response()->json([
            'massage' => 'comment submitted',
            'comment' => new CommentResource(Comment::create($validated))
        ], 201);
    }

    public function index(ShowCommentsRequest $request)
    {
        ($request->isNotFilled('restaurant_id')) ?

            $comments = Food::find($request->validated('food_id'))
                ->carts()->has('comment')->get()->pluck('comment')

            : $comments = Restaurant::find($request->validated('restaurant_id'))
            ->carts()->has('comment')->get()->pluck('comment');

        if ($comments->isEmpty()) return \response()->json(['massage' => 'no comments found'], 404);
        return response()->json(['comment' => CommentResource::collection($comments)]);
    }
}
