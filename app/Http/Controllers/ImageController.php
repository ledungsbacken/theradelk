<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Image;

class ImageController extends Controller
{
    public function upload(Request $request) {
        $mime_type = $request->file('file')->getMimeType();
        $url = '';
        $image = Image::create([
            'url' => $url
        ]);
        return $image;
    }
}
