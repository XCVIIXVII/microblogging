<!-- resources/views/posts/comment-edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Comment</h1>
        <form method="POST" action="{{ route('comments.update', $comment) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" required>{{ old('content', $comment->content) }}</textarea>
            </div>
            <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
            <button type="submit" class="btn btn-primary">Update Comment</button>
        </form>
    </div>
@endsection
