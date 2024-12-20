<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        // Increment the comments_count on the post
        $post->increment('comments_count');

        return back();
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->post->decrement('comments_count');
        $comment->delete();

        return back();
    }
}
