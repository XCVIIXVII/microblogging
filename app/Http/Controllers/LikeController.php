<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $like = Like::where('user_id', $request->user()->id)
            ->where('post_id', $request->post_id)
            ->first();

        if ($like) {
            return redirect()->back()->with('error', 'You have already liked this post.');
        }

        $request->user()->likes()->create([
            'post_id' => $request->post_id,
        ]);

        return redirect()->back()->with('success', 'Post liked successfully.');
    }

    public function destroy(Request $request, $postId)
    {
        $like = Like::where('user_id', $request->user()->id)
            ->where('post_id', $postId)
            ->first();

        if ($like) {
            $like->delete();
            return redirect()->back()->with('success', 'Post unliked successfully.');
        }

        return redirect()->back()->with('error', 'You have not liked this post.');
    }
}
