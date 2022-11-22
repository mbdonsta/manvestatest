<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('comment', $post);

        $this->validate($request, [
            'comment' => 'required|min:20'
        ]);

        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment' => $request->comment
        ]);

        session()->flash('success', 'Your comment was posted.');

        return back();
    }
}
