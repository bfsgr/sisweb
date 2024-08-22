<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(): View
    {
        $comments = Comment::where('user_id', auth()->user()['id'])->paginate(10);

        return view('home', compact('comments'));
    }
}
