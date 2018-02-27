<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Role;
use App\Post;
use App\LoggedInLog;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'picture',
        'about',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function hasPermission($permission)
    {
        $hasPermission = false;
        $this->roles->each(function ($role) use (&$hasPermission, $permission){
            $hasPermission = $role->hasPermission($permission);
            if($hasPermission){
                return false;
            }
        });
        return $hasPermission;
    }

    public function logged_in_log() {
        return $this->hasMany(LoggedInLog::class);
    }

}
