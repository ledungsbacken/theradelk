<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Image;

class ImageController extends Controller
{
    public function show($id) {

    }

    public function upload(Request $request) {
        $allowedExtensions = ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif', 'image/tiff', 'image/x-tiff'];
        $mime_type = $request->file('file')->getMimeType();
        dd($mime_type);
        $path = $request->file('file')->store('images', 'public');
        $url = $path;
        $image = Image::create([
            'url' => $url
        ]);
        return $image;
    }
}
