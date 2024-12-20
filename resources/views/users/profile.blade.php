<!-- resources/views/users/profile.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-6">
        <!-- User Info -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8 border border-gray-200 text-center">
            <img src="https://picsum.photos/seed/{{ $user->id }}/100" alt="{{ $user->name }}" class="w-24 h-24 rounded-full mx-auto mb-4">
            <h1 class="text-xl font-bold text-gray-900">{{ $user->name }}</h1>
            <p class="text-gray-600">{{ $user->email }}</p>
            <p class="mt-2 text-sm text-gray-500">Joined {{ $user->created_at->diffForHumans() }}</p>
        </div>

        <!-- User Posts -->
        <h3 class="text-xl font-bold text-gray-900 mb-4">Posts</h3>
        @foreach ($user->posts as $post)
            <div class="bg-white p-6 rounded-lg shadow-md mb-4 border border-gray-200">
                <p class="text-gray-800 text-lg">{{ $post->content }}</p>
                <p class="text-sm text-gray-600 mt-2">{{ $post->created_at->diffForHumans() }}</p>
            </div>
        @endforeach

        @if ($user->posts->isEmpty())
            <p class="text-gray-500 text-center">No posts yet.</p>
        @endif
    </div>
</x-app-layout>
