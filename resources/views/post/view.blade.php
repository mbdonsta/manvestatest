@extends('layouts.app')

@section('content')
    <div class="posts-container py-5">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mb-5">{{ $post->title }}</h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('posts') }}" class="btn btn-primary">Back to posts</a>
            </div>
        </div>
        @include('parts.notices')
        <div class="card mb-3 post-item">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        @if ($post->is_private)
                            <p class="mb-0 fs-6 fw-bold">This post is private and is not visible to others</p>
                        @endif
                    </div>
                    <div class="col-md-6 text-md-end">
                        @can('edit', $post)
                            <a href="{{ route('post.edit', ['post' => $post->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Author: {{ $post->user->name }}</strong>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <strong>{{ $post->created_at->format('Y F d') }}</strong>
                    </div>
                </div>
                <p>{{ $post->content }}</p>
            </div>
        </div>
        <div class="mb-4">
            <h3>Comment this post</h3>
            <form action="{{ route('comment.store', ['post' => $post->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea
                        id="post-content"
                        type="text"
                        class="form-control @error('comment') is-invalid @enderror"
                        name="comment"
                        rows="5"
                        placeholder="Your comment goes here">{{ old('comment') }}</textarea>
                    @error('comment')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit comment</button>
                </div>
            </form>
        </div>
        <div class="post-comments">
            <h4> What people say about this post</h4>
            @forelse ($post->comments as $comment)
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>{{ $comment->user->name }}</strong>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <strong>{{ $comment->created_at->format('Y F d H:i') }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $comment->comment }}
                    </div>
                </div>
            @empty
                <p>Be the first who comments this post.</p>
            @endforelse
        </div>
    </div>
@stop
