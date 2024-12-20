<x-app-layout>
    <!-- Page Heading -->
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <!-- Page Content -->
    <div class="max-w-3xl mx-auto py-8 px-6">
        <!-- Create Post Form -->
        <form action="{{ route('posts.store') }}" method="POST" class="mb-8 bg-white p-6 rounded-lg shadow-md border border-gray-200">
            @csrf
            <textarea name="content" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="What's on your mind?" required></textarea>
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-400">Post</button>
            </div>
        </form>

        <!-- Display Posts -->
        @foreach ($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow-md mb-8 border border-gray-200 relative">
                <!-- Dropdown at top right -->
                <div class="absolute top-0 right-0 mt-2 mr-2">
                    @can('update', $post)
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 6h12M6 18h12"></path>
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="absolute top-0 right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                    <!-- Edit Post -->
                                    <x-dropdown-link :href="route('posts.edit', $post)">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                    <!-- Delete Post -->
                                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-dropdown-link :href="route('posts.destroy', $post)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    @endcan
                </div>

                <div class="flex items-center mb-4">
                    <img src="https://picsum.photos/seed/{{ $post->user->id }}/100" alt="{{ $post->user->name }}" class="w-12 h-12 rounded-full border border-gray-300 mr-4">
                    <div>
                        <p class="font-bold text-gray-900">{{ $post->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <p class="text-gray-800 text-lg mb-4">{{ $post->content }}</p>
                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                    <div class="flex space-x-4">
                        <!-- Like/Unlike Button -->
                        @if ($post->likes->contains('user_id', auth()->id()))
                            <form action="{{ route('posts.unlike', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center text-blue-500 hover:text-blue-700 whitespace-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                    </svg>
                                    <span>{{ $post->likes_count }} Likes</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('posts.like', $post) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center text-gray-500 hover:text-blue-500 whitespace-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                    </svg>
                                    <span>{{ $post->likes_count }} Likes</span>
                                </button>
                            </form>
                        @endif

                        <!-- Comment Button -->
                        <button onclick="toggleCommentSection({{ $post->id }})" class="flex items-center text-gray-500 hover:text-blue-500 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                            </svg>
                            <span>{{ $post->comments_count }} Comments</span>
                        </button>
                    </div>

                </div>

                <!-- Comments Section -->
                <div id="comment-form-{{ $post->id }}" class="mt-4 hidden">
                    <!-- Add Comment Form -->
                    <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-4">
                        @csrf
                        <textarea name="content" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Add a comment..." required></textarea>
                        <div class="flex justify-end mt-2">
                            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Comment</button>
                        </div>
                    </form>

                    <!-- Display Comments -->
                    @foreach ($post->comments as $comment)
                        <div class="flex items-start mb-4">
                            <img src="{{ $comment->user->profile_picture }}" alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full mr-3 border border-gray-300">
                            <div class="bg-gray-100 p-4 rounded-lg w-full">
                                <div class="flex justify-between items-center mb-2">
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

<script>
    function toggleCommentSection(postId) {
        const commentSection = document.getElementById(`comment-form-${postId}`);
        commentSection.classList.toggle('hidden');
    }
</script>
