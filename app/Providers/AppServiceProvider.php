<?php

namespace App\Providers;

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Policies\PostPolicy;
use App\Models\Comment;
use App\Policies\CommentPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register bindings or singletons here
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register policies
        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);
    }
}

