<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Auth;

use App\Image;
use App\Post;

class ImageController extends Controller
{
    /**
     * @param Request $request
     * @return Post
     */
    public function index(Request $request) {
        $images = Image::where('user_id', '=', Auth::id())
                     ->orderBy('id', 'DESC')
                     ->paginate((int)$request['count']);
        return $images;
    }

    public function upload(Request $request) {
        // Return 403 if not enough permissions
        if(Auth::user()->cant('create', Post::class)) { return response()->json('Forbidden', 403); }

        $allowedExtensions = ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif', 'image/tiff', 'image/x-tiff'];
        $mime_type = $request->file('file')->getMimeType();
        if(!in_array($mime_type, $allowedExtensions)) { return response()->json('Unsupported Media Type', 415); }
        $path = $request->file('file')->store('images', 'public');
        $url = $path;
        $image = Image::create([
            'url' => '/'.$url,
        ]);
        $image->user()->associate(Auth::id())->save();
        return $image;
    }

    public function destroy(Request $request, $id) {
        // Return 403 if not enough permissions
        if(Auth::user()->cant('create', Post::class)) { return response()->json('Forbidden', 403); }
        $image = Image::find((int)$id);
        unlink(storage_path('app/public'.$image->url));
        $image->delete();
        return $image;
    }
}