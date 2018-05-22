<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Auth;
use App\SocialLink;
use App\SocialLinkType;
use App\User;

class SocialLinkController extends Controller
{
    /**
     * @param Request $request
     * @return SocialLink
     */
    public function index(Request $request) {
        $user = User::find((int)$request->user_id);
        return SocialLink::where('user_id', '=', $user->id)->orderBy('type_id', 'DESC')->get();
    }

    /**
     * @param Request $request
     * @return Category
     */
    public function store(Request $request) {
        if(!(int)$request->type_id) {
            return response()->json('Bad Request', 400);
        }
        if($request->user_id) {
            $user = User::find((int)$request->user_id);
            $user = Auth::user()->cant('update', $user) ? Auth::user() : $user;
        } else {
            $user = Auth::user();
        }

        // Return 403 if not enough permissions
        if(Auth::user()->cant('update', $user)) { return response()->json('Forbidden', 403); }

        if($user->socialLinks->count() >= 5) {
            return response()->json('Bad Request: You cannot have more than 5 links', 400);
        }

        $socialLink = SocialLink::create([
            'url' => $request->url,
        ]);

        $socialLink->user()->associate($user);

        $type = SocialLinkType::find((int)$request->type_id);
        $socialLink->type()->associate($type);

        $socialLink->save();

        return $socialLink->fresh();
    }

    /**
     * @param Request $request
     * @return Category
     */
    public function update(Request $request, $id) {
        $socialLink = SocialLink::find((int)$id);
        // Return 403 if not enough permissions
        if(Auth::user()->cant('update', $socialLink->user)) { return response()->json('Forbidden', 403); }
        $socialLink->update($request->all());
        return $socialLink;
    }

    /**
     * @param $id
     * @return Post
     */
    public function destroy($id) {
        $socialLink = SocialLink::find((int)$id);
        // Return 403 if not enough permissions
        if(Auth::user()->cant('update', $socialLink->user)) { return response()->json('Forbidden', 403); }
        $socialLink->delete();
        return $socialLink;
    }
}