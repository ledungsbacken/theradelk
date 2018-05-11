<?php

namespace App\Policies;

use App\User;
use App\Scenery;
use Illuminate\Auth\Access\HandlesAuthorization;

class SceneryPolicy
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
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Scenery $scenery)
    {
        if($user->hasPermission('admin_posts')) {
            return true;
        }
        return false;
    }
}