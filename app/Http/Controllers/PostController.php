<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        $request->user()->posts()->create([
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
