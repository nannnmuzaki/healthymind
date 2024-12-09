<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Allow create if the user has therapist or admin role
        return auth()->user()->role === 2 || auth()->user()->role === 3;  
    }

    /**
     * Determine whether the user can store models.
     */
    public function store(User $user): bool
    {
        // Allow store if the user has therapist or admin role
        return auth()->user()->role === 2 || auth()->user()->role === 3;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BlogPost $blogPost): bool
    {
        // Allow update if the user is the author of the post or has admin role
        return $user->id === $blogPost->user_id || auth()->user()->role === 3;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BlogPost $blogPost): bool
    {
        // Allow delete if the user is the author of the post or has admin role
        return $user->id === $blogPost->user_id || auth()->user()->role === 3;
    }
}
