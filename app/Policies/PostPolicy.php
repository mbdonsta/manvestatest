<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    public function view(User $user, Post $post): bool
    {
        return !$post->isPrivate() || $post->user_id === $user->id;
    }

    public function edit(User $user, Post $post): bool
    {
        return $post->user_id === $user->id;
    }

    public function comment(User $user, Post $post): bool
    {
        return !$post->isPrivate() || $post->user_id === $user->id;
    }
}
