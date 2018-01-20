<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\LoggedInLog;

class UserController extends Controller
{
    public function index(Request $request) {
        $current_user = User::find(Auth::id());
        if($current_user->hasPermission('full')) {
            $users = User::with('roles')->get();
            return $users;
        }
        return response()->json('Forbidden', 403);
    }

    public function logged_in_log() {
        $log = LoggedInLog::with('user')->orderBy('id', 'DESC')->get();
        return $log;
    }
}
