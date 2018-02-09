<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Hash;

use App\User;
use App\Role;
use App\LoggedInLog;

class UserController extends Controller
{
    public function index(Request $request) {
        if(Auth::user()->cant('view', User::class)) { return response()->json('Forbidden', 403); }
        $users = User::with('roles')->get();
        return $users;
    }

    public function indexRoles(Request $request) {
        if(Auth::user()->cant('view', User::class)) { return response()->json('Forbidden', 403); }
        $where = [
            ['name', '!=', 'super_admin']
        ];
        User::find((int)$request['user_id'])->roles()->each(function($role) use (&$where) {
            $where[] = ['id', '!=', $role->id];
        });

        $users = Role::where($where)->get();
        return $users;
    }

    public function show($id) {
        $user = User::with('roles')->find((int)$id);
        return $user;
    }

    public function store(Request $request) {
        $user = User::create($request->all());
        return $user;
    }

    public function update(Request $request, $id) {
        $user = User::find((int)$id);
        $user->update($request->all());
        return $user->load('roles');
    }

    public function resetPassword(Request $request, $id) {
        if(Auth::user()->cant('update', User::class)) { return response()->json('Forbidden', 403); }
        $user = User::find((int)$id);
        if($user->hasPermission('full')) { return response()->json('Forbidden', 403); }
        $password = $request->params['newPassword'];
        $passwordConfirm = $request->params['newPasswordConfirm'];
        if($password != $passwordConfirm) { return response()->json('Forbidden', 403); }
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->save();
        return $user->load('roles');
    }

    public function syncRoles(Request $request, $id) {
        $user = User::find((int)$id);
        $roles = [];
        foreach($request->params['roles'] as $role) {
            $roles[] = $role['data']['id'];
        }
        $user->roles()->sync($roles);
        return $user->load('roles');
    }

    public function destroy($id) {
        $user = User::find((int)$id);
        $user->delete();
        return $user;
    }

    public function loggedInLog() {
        $log = LoggedInLog::with('user')->orderBy('id', 'DESC')->get();
        return $log;
    }

    public function getCurrent() {
        $return = null;
        if(Auth::check()) {
            $return = User::with('roles')->find(Auth::user()->id);
        }
        return $return;
    }

    public function isLoggedIn(Request $request) {
        $return = [];
        $return['status'] = false;
        if(Auth::check()) {
            $return['status'] = true;
        }
        return $return;
    }
}
