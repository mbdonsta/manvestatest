@extends('layouts.app')

@section('content')
    <div class="posts-container py-5">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mb-5">Blog posts</h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('post.add') }}" class="btn btn-primary">Add new post</a>
            </div>
        </div>
        <div class="post-items">
            @include('parts.notices')
            @forelse($posts as $post)
                <div class="card mb-3 post-item">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mb-0">
                                    {{ $post->title }}
                                    @if ($post->is_private)
                                        <p class="mb-0 fs-6 fw-bold">This post is private and is not visible to others</p>
                                    @endif
                                </h3>
                            </div>
                            <div class="col-md-6 text-md-end">
                                @can('edit', $post)
                                    <a href="{{ route('post.edit', ['post' => $post->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
                                @endcan
                                @can('view', $post)
                                    <a href="{{ route('post.view', ['post' => $post->id]) }}" class="btn btn-sm btn-primary">View</a>
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
                    <div class="card-footer">
                        <span>{{ $post->comments_count }} comments</span>
                    </div>
                </div>
            @empty
                <p>There are no blog posts.</p>
            @endforelse
        </div>
    </div>
@stop
