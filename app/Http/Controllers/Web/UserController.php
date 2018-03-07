<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Auth;
use Hash;

use App\User;
use App\Role;
use App\LoggedInLog;

class UserController extends Controller
{
    public function index(Request $request) {
        if(Auth::user()->cant('view', User::class)) { return response()->json('Forbidden', 403); }
        $users = User::with('roles')->withCount('posts')->get();
        return $users;
    }

    public function indexRoles(Request $request) {
        if(Auth::user()->cant('view', User::class)) { return response()->json('Forbidden', 403); }
        $where = [
            ['name', '!=', 'super_admin']
        ];
        if((int)$request['user_id']) {
            User::find((int)$request['user_id'])->roles()->each(function($role) use (&$where) {
                $where[] = ['id', '!=', $role->id];
            });
        }

        $users = Role::where($where)->get();
        return $users;
    }

    public function show($id) {
        $user = User::with('roles')->withCount(['posts' => function($query) {
            return $query->where([
                ['published', '1'],
            ]);
        }])->find((int)$id);
        return View('user.show')->with('user', $user);
    }
}
