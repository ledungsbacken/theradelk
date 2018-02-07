<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\HeadImage;
use App\Post;

class HeadImageController extends Controller
{
    /**
     * @param Request $request
     * @return Post
     */
    public function index(Request $request) {
        $images = HeadImage::where('user_id', '=', Auth::id())
                     ->orderBy('id', 'DESC')
                     ->paginate((int)$request['count']);
        return $images;
    }

    public function show($id) {

    }

    public function upload(Request $request) {
        // Return 403 if not enough permissions
        if(Auth::user()->cant('create', Post::class)) { return response()->json('Forbidden', 403); }

        $allowedExtensions = ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif', 'image/tiff', 'image/x-tiff'];

        $thumbnail_mime_type = $request->file('thumbnail')->getMimeType();
        if(!in_array($thumbnail_mime_type, $allowedExtensions)) { return response()->json('Unsupported Media Type', 415); }
        $thumbnail_path = $request->file('thumbnail')->store('images', 'public');
        $thumbnail = $thumbnail_path;

        $desktop_mime_type = $request->file('desktop')->getMimeType();
        if(!in_array($desktop_mime_type, $allowedExtensions)) { return response()->json('Unsupported Media Type', 415); }
        $desktop_path = $request->file('desktop')->store('images', 'public');
        $desktop = $desktop_path;

        $tablet_mime_type = $request->file('tablet')->getMimeType();
        if(!in_array($tablet_mime_type, $allowedExtensions)) { return response()->json('Unsupported Media Type', 415); }
        $tablet_path = $request->file('tablet')->store('images', 'public');
        $tablet = $tablet_path;

        $phone_mime_type = $request->file('phone')->getMimeType();
        if(!in_array($phone_mime_type, $allowedExtensions)) { return response()->json('Unsupported Media Type', 415); }
        $phone_path = $request->file('phone')->store('images', 'public');
        $phone = $phone_path;
        $image = HeadImage::create([
            'thumbnail' => $thumbnail,
            'desktop' => $desktop,
            'tablet' => $tablet,
            'phone' => $phone,
        ]);
        $image->user()->associate(Auth::id())->save();
        return $image;
    }
}
