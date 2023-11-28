<?php

namespace App\Http\Controllers\admin;

use App\Classes\CommentsStatus;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::query()->where('status',CommentsStatus::Delete)->get();
        return view('admin.comment.index',compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comment.index');
    }

    public function cancel(Comment $comment)
    {
        $comment->update(['status' => CommentsStatus::NoReply]);
        return redirect()->route('admin.comment.index');
    }
}
