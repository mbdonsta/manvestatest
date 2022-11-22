<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('user')
            ->withCount('comments')
            ->where('user_id', auth()->user()->id)
            ->orWhere('is_private', Post::PUBLIC_STATUS)
            ->latest()
            ->get();

        return view('post.index', compact('posts'));
    }

    public function add(): View
    {
        $postStatuses = Post::getAvailableStatuses();

        return view('post.add', compact('postStatuses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required|max:256',
            'content' => 'required',
            'status' => 'required'
        ]);

        Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status
        ]);

        session()->flash('success', 'Your post published successfully.');

        return redirect()->route('posts');
    }

    public function edit(Post $post): View
    {
        $this->authorize('edit', $post);

        $postStatuses = Post::getAvailableStatuses();

        return view('post.edit', compact('post', 'postStatuses'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('edit', $post);

        $this->validate($request, [
            'title' => 'required|max:256',
            'content' => 'required',
            'status' => 'required'
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status
        ]);

        session()->flash('success', 'Your post was updated successfully.');

        return back();
    }

    public function view(Post $post): View
    {
        $this->authorize('view', $post);

        return view('post.view', compact('post'));
    }
}
