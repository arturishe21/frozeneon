<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Services\CalculateLikes;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function add(Post $post)
    {
        $post->comments()->create([
            'user_id' => Auth::id(),
            'text' => request()->get('text'),
            'reply_id' => request()->get('reply_id'),
            'likes' => 0
        ]);

        return response()->json([
            'comments' => $post->refresh()->comments
        ]);
    }

    public function like(Comment $comment, CalculateLikes $calculateLikes)
    {
        return $calculateLikes->handle($comment);
    }
}
