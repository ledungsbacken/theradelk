<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Determine whether the user can view models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        if($user->hasPermission('admin_users')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->hasPermission('admin_users')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if($user->hasPermission('admin_users')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        // if($user->hasPermission('admin_users')) {
        //     return true;
        // }
        return false;
    }
}
