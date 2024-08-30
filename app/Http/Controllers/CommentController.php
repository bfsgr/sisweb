<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(): View
    {
        if (request()->user()->role == 'employee') {
            $comments = Comment::orderBy('created_at', 'DESC')
                ->paginate(10);
        } else {
            $comments = Comment::where('user_id', auth()->user()['id'])
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }

        return view('home', compact('comments'));
    }

    function store(): RedirectResponse
    {
        $validator = Validator::make(request()->all(), [
            'text' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $comment = new Comment();
        $comment->text = $data['text'];
        $comment->user_id = auth()->user()['id'];

        if ($comment->save()) {
            return redirect()->route('comments.index');
        } else {
            return back()->with('error', 'Erro ao criar comentário')->withInput();
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $comment = Comment::findOrFail($id);

        if (request()->user()->cannot('delete', $comment)) {
            abort(403);
        }

        if ($comment->delete()) {
            return redirect()->route('comments.index');
        } else {
            return back()->with('error', 'Erro ao deletar comentário');
        }
    }
}
