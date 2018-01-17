<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;

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
}
