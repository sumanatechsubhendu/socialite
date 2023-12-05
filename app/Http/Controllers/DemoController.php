<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    /**
     * Display the polymorphic relation
     */
    public function index(Request $request)
    {
        $a = Post::all();
        dd($a);
    }

    /**
     * Display the polymorphic relation
     */
    public function details(Request $request)
    {
        $comment = Comment::find(1);
        $commentable = $comment->commentable;
        dd($comment);
    }
}
