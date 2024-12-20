<!-- resources/views/posts/index.blade.php -->
<x-app-layout>
    <!-- Page Heading -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <!-- Page Content -->
    <div class="max-w-2xl mx-auto py-6">
        <!-- Create Post Form -->
        <form action="{{ route('posts.store') }}" method="POST" class="mb-6 bg-white p-4 rounded-lg shadow">
            @csrf
            <textarea name="content" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="What's on your mind?" required></textarea>
            <div class="flex justify-end mt-2">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">Post</button>
            </div>
        </form>

        <!-- Display Posts -->
        @foreach ($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <div class="flex items-center mb-4">
                    <img src="{{ $post->user->profile_picture }}" alt="{{ $post->user->name }}" class="w-12 h-12 rounded-full mr-3">
                    <div>
                        <p class="font-bold text-gray-900">{{ $post->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <p class="text-gray-800 mb-4">{{ $post->content }}</p>
                <div class="flex items-center justify-between">
                    <div class="flex space-x-4">
                        <!-- Like/Unlike Button -->
                        @if ($post->likes->contains('user_id', auth()->id()))
                            <form action="{{ route('posts.unlike', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center text-gray-500 hover:text-blue-500 focus:outline-none">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9l-2-2m0 0l-2 2m2-2v6m0 4h.01M12 19a7 7 0 100-14 7 7 0 000 14z"></path>
                                    </svg>
                                    <span>Unlike</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('posts.like', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center text-gray-500 hover:text-blue-500 focus:outline-none">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 9l-2-2m0 0l-2 2m2-2v6m0 4h.01M12 19a7 7 0 100-14 7 7 0 000 14z"></path>
                                    </svg>
                                    <span>{{ $post->likes_count }} Likes</span>
                                </button>
                            </form>
                        @endif
                        <!-- Comment Button -->
                        <button onclick="document.getElementById('comment-form-{{ $post->id }}').classList.toggle('hidden')" class="flex items-center text-gray-500 hover:text-blue-500 focus:outline-none">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 16v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2h3l4 4 4-4h3a2 2 0 002-2z"></path>
                            </svg>
                            <span>{{ $post->comments_count }} Comments</span>
                        </button>
                    </div>
                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600 focus:outline-none">Delete</button>
                        </form>
                    @endcan
                </div>
                <!-- Comments Section -->
                <div id="comment-form-{{ $post->id }}" class="mt-4 hidden">
                    <!-- Add Comment Form -->
                    <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-4">
                        @csrf
                        <textarea name="content" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Add a comment..." required></textarea>
                        <div class="flex justify-end mt-1">
                            <button type="submit" class="bg-blue-500 text-white py-1 px-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">Comment</button>
                        </div>
                    </form>
                    <!-- Display Comments -->
                    @foreach ($post->comments as $comment)
                        <div class="flex items-start mb-4">
                            <img src="{{ $comment->user->profile_picture }}" alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full mr-3">
                            <div class="bg-gray-100 p-3 rounded-lg w-full">
                                <div class="flex justify-between items-center">
                                    <p class="font-bold text-gray-900">{{ $comment->user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                                <p class="text-gray-800">{{ $comment->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
