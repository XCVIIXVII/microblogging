@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- Post Creation Form -->
        <form action="{{ route('posts.store') }}" method="POST" class="mb-4">
            @csrf
            <textarea name="content" class="w-full p-2 border rounded" placeholder="What's on your mind?" required></textarea>
            <button type="submit" class="mt-2 bg-blue-500 text-white py-2 px-4 rounded">Post</button>
        </form>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display Posts -->
        @foreach ($posts as $post)
            <div class="bg-white p-4 rounded mb-4">
                <!-- Post Author and Timestamp -->
                <div class="flex items-center mb-2">
                    <img src="{{ $post->user->profile_picture }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full mr-2">
                    <div>
                        <p class="font-bold">{{ $post->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <!-- Post Content -->
                <p>{{ $post->content }}</p>

                <!-- Like and Comment Counts -->
                <div class="flex items-center mt-2">
                    <span class="text-gray-600 mr-4">
                        {{ $post->likes_count }} {{ Str::plural('like', $post->likes_count) }}
                    </span>
                    <span class="text-gray-600">
                        {{ $post->comments_count }} {{ Str::plural('comment', $post->comments_count) }}
                    </span>
                </div>

                <!-- Like/Unlike Button -->
                <div class="mt-2">
                    @auth
                        <form action="{{ $post->isLikedBy(auth()->user()) ? route('posts.unlike', $post) : route('posts.like', $post) }}" method="POST" class="inline">
                            @csrf
                            @if($post->isLikedBy(auth()->user()))
                                @method('DELETE')
                                <button type="submit" class="text-blue-500">Unlike</button>
                            @else
                                <button type="submit" class="text-blue-500">Like</button>
                            @endif
                        </form>
                    @endauth
                </div>

                <!-- Delete Post Button -->
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                @endcan

                <!-- Display Comments -->
                @if($post->comments->isNotEmpty())
                    <div class="mt-4">
                        @foreach ($post->comments as $comment)
                            <div class="bg-gray-100 p-2 rounded mb-2">
                                <p class="font-semibold">{{ $comment->user->name }}</p>
                                <p>{{ $comment->content }}</p>
                                <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                                @can('delete', $comment)
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="mt-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 text-sm">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Add Comment Form -->
                @auth
                    <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
                        @csrf
                        <textarea name="content" class="w-full p-2 border rounded" placeholder="Add a comment..." required></textarea>
                        <button type="submit" class="mt-2 bg-green-500 text-white py-1 px-3 rounded">Comment</button>
                    </form>
                @endauth
            </div>
        @endforeach
    </div>
@endsection
