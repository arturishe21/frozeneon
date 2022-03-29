<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\CalculateLikes;

class PostController extends Controller
{
    public function getPost(Post $post)
    {
        return response()->json($post);
    }

    public function like(Post $post, CalculateLikes $calculateLikes)
    {
        return $calculateLikes->handle($post);
    }
}
