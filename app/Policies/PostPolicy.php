<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  $ability
     * @return mixed
     */
    public function before(User $user, $ability)
    {
        if($user->hasPermission('full')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->hasPermission('create_posts')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        if($user->id == $post->user_id && $user->hasPermission('my_content') || $user->hasPermission('edit_posts')) {
            return true
        }
        return false;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        if($user->id == $post->user_id && $user->hasPermission('my_content') || $user->hasPermission('admin_posts')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        if($user->hasPermission('delete_posts')) {
            return true;
        }
        return false;
    }
}
