<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Boosterpack;
use App\Models\Post;

class MainController extends Controller
{
    public function index()
    {
        return response()->json([
            'posts' => Post::all(),
            'boosterpacks' => Boosterpack::all(),
        ]);
    }
}
