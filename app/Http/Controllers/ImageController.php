<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Image;
use App\Post;

class ImageController extends Controller
{
    public function show($id) {

    }

    public function upload(Request $request) {
        // Return 403 if not enough permissions
        if(Auth::user()->cant('create', Post::class)) { return response()->json('Forbidden', 403); }

        $allowedExtensions = ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif', 'image/tiff', 'image/x-tiff'];
        $mime_type = $request->file('file')->getMimeType();
        $path = $request->file('file')->store('images', 'public');
        $url = $path;
        $image = Image::create([
            'url' => $url
        ]);
        return $image;
    }
}
