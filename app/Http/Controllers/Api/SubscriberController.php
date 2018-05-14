<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Validator;

use App\Subscriber;

class SubscriberController extends Controller
{
    public function index(Request $request) {
        if(Auth::user()->cant('view', User::class)) { return response()->json('Forbidden', 403); }
        $users = User::with('roles', 'socialLinks')->withCount('posts')->get();
        return $users;
    }

    public function show($id) {
        $user = User::with('roles', 'socialLinks')->withCount(['posts' => function($query) {
            return $query->whereNotNull('published');
        }])->find((int)$id);
        return View('user.show')->with('user', $user);
    }

    public function store(Request $request, Subscriber $subscriber) {
        $validator = Validator::make($request->all(), $subscriber->rules, $subscriber->messages);
        if($validator->fails()) {
            if(in_array('The email has already been taken.', $validator->errors()->messages()['email'])) {
                return response()->json(new Subscriber($request->all()), 200);
            }
            return response()->json($validator->errors(), 422);
        }

        $subscriber = Subscriber::create([
            'email' => $request->email,
        ]);

        return $subscriber;
    }

    public function update(Request $request, $id) {
        $user = User::find((int)$id);
        if(Auth::user()->cant('update', $user)) { return response()->json('Forbidden', 403); }
        $user->update($request->all());
        return $user->load('roles');
    }

    public function destroy($id) {
        $user = User::find((int)$id);
        if(Auth::user()->cant('delete', $user)) { return response()->json('Forbidden', 403); }
        $user->delete();
        return $user;
    }
}
