<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index():JsonResponse
    {
        $posts = Post::with('user')
            ->withCount('comments')
            ->where('user_id', auth()->user()->id)
            ->orWhere('is_private', Post::PUBLIC_STATUS)
            ->latest()
            ->get();

        return response()->json([
            'status' => 'OK',
            'total' => count($posts),
            'posts' => $posts
        ]);
    }

    public function getPostsByUser(User $user): JsonResponse
    {
        $posts = Post::with('user')
            ->withCount('comments')
            ->where('user_id', $user->id);

        if (auth()->user()->id !== $user->id) {
            $posts = $posts->where('is_private', Post::PUBLIC_STATUS);
        }

        $posts = $posts->latest()->get();

        return response()->json([
            'status' => 'OK',
            'total' => count($posts),
            'posts' => $posts
        ]);
    }

    public function getPost(Post $post): JsonResponse
    {
        $this->authorize('view', $post);

        return response()->json([
            'status' => 'OK',
            'post' => $post->load('comments'),
        ]);
    }
}
