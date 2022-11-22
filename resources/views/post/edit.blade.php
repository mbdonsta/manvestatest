@extends('layouts.app')

@section('content')
    <div class="posts-container py-5">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mb-5">Edit post</h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('posts') }}" class="btn btn-primary">Go back</a>
            </div>
        </div>
        @include('parts.notices')
        <div class="card post-form">
            <div class="card-body">
                <form action="{{ route('post.update', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="post-title" class="form-label">Post title</label>
                        <input
                            id="post-title"
                            type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            name="title"
                            placeholder="Enter your post title"
                            value="{{ old('title', $post->title) }}">
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="post-content" class="form-label">Post content</label>
                        <textarea
                            id="post-content"
                            type="text"
                            class="form-control @error('content') is-invalid @enderror"
                            name="content"
                            rows="5"
                            placeholder="Enter your post content">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="post-content" class="form-label">Post status</label>
                        <select id="post-status" class="form-select @error('status') is-invalid @enderror" name="status">
                            @foreach ($postStatuses as $status)
                                <option value="{{ $status['value'] }}" {{ old('status', $post->status) === $status['value'] ? 'selected' : '' }}>
                                    {{ $status['label'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
