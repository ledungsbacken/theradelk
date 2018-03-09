<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
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

        $sizes = [
            'thumbnail' => [
                'width' => 548,
                'height' => 650,
                'bytes' => 6000000,
            ],
            'desktop' => [
                'width' => 1920,
                'height' => 1080,
                'bytes' => 6000000,
            ],
            'tablet' => [
                'width' => 900,
                'height' => 1000,
                'bytes' => 6000000,
            ],
            'phone' => [
                'width' => 480,
                'height' => 270,
                'bytes' => 6000000,
            ],
        ];

        // Validate images
        $thumbnailMimeType = $request->file('thumbnail')->getMimeType();
        if(!in_array($thumbnailMimeType, $allowedExtensions)) { return response()->json('Unsupported Media Type | Only the following formats are allowed '.implode(', ', $allowedExtensions), 415); }
        $thumbnailSize = getimagesize($request->file('thumbnail'));
        if($thumbnailSize[0] != $sizes['thumbnail']['width'] || $thumbnailSize[1] != $sizes['thumbnail']['height'])
        { return response()->json('Not Acceptable | Image width must be '.$sizes['thumbnail']['width'].'px and height must be '.$sizes['thumbnail']['height'].'px', 406); }
        $thumbnailFileSize = $request->file('thumbnail')->getClientSize();
        if($thumbnailFileSize > $sizes['thumbnail']['bytes'])
        { return response()->json('Payload Too Large | Max filesize for thumbnail is '.round($sizes['thumbnail']['bytes'] / 1024 / 1024, 2).'mb', 413); }

        $desktopMimeType = $request->file('desktop')->getMimeType();
        if(!in_array($desktopMimeType, $allowedExtensions)) { return response()->json('Unsupported Media Type | Only the following formats are allowed '.implode(', ', $allowedExtensions), 415); }
        $desktopSize = getimagesize($request->file('desktop'));
        if($desktopSize[0] != $sizes['desktop']['width'] || $desktopSize[1] != $sizes['desktop']['height'])
        { return response()->json('Not Acceptable | Image width must be '.$sizes['desktop']['width'].'px and height must be '.$sizes['desktop']['height'].'px', 406); }
        $desktopFileSize = $request->file('desktop')->getClientSize();
        if($desktopFileSize > $sizes['desktop']['bytes'])
        { return response()->json('Payload Too Large | Max filesize for desktop is '.round($sizes['desktop']['bytes'] / 1024 / 1024, 2).'mb', 413); }

        $tabletMimeType = $request->file('tablet')->getMimeType();
        if(!in_array($tabletMimeType, $allowedExtensions)) { return response()->json('Unsupported Media Type | Only the following formats are allowed '.implode(', ', $allowedExtensions), 415); }
        $tabletSize = getimagesize($request->file('tablet'));
        if($tabletSize[0] != $sizes['tablet']['width'] || $tabletSize[1] != $sizes['tablet']['height'])
        { return response()->json('Not Acceptable | Image width must be '.$sizes['tablet']['width'].'px and height must be '.$sizes['tablet']['height'].'px', 406); }
        $tabletFileSize = $request->file('tablet')->getClientSize();
        if($tabletFileSize > $sizes['tablet']['bytes'])
        { return response()->json('Payload Too Large | Max filesize for tablet is '.round($sizes['tablet']['bytes'] / 1024 / 1024, 2).'mb', 413); }

        $phoneMimeType = $request->file('phone')->getMimeType();
        if(!in_array($phoneMimeType, $allowedExtensions)) { return response()->json('Unsupported Media Type | Only the following formats are allowed '.implode(', ', $allowedExtensions), 415); }
        $phoneSize = getimagesize($request->file('phone'));
        if($phoneSize[0] != $sizes['phone']['width'] || $phoneSize[1] != $sizes['phone']['height'])
        { return response()->json('Not Acceptable | Image width must be '.$sizes['phone']['width'].'px and height must be '.$sizes['phone']['height'].'px', 406); }
        $phoneFileSize = $request->file('phone')->getClientSize();
        if($phoneFileSize > $sizes['phone']['bytes'])
        { return response()->json('Payload Too Large | Max filesize for phone is '.round($sizes['phone']['bytes'] / 1024 / 1024, 2).'mb', 413); }

        // Store images
        $thumbnailPath = $request->file('thumbnail')->store('images', 'public');
        $thumbnail = $thumbnailPath;

        $desktopPath = $request->file('desktop')->store('images', 'public');
        $desktop = $desktopPath;

        $tabletPath = $request->file('tablet')->store('images', 'public');
        $tablet = $tabletPath;

        $phonePath = $request->file('phone')->store('images', 'public');
        $phone = $phonePath;

        $image = HeadImage::create([
            'thumbnail' => '/'.$thumbnail,
            'desktop' => '/'.$desktop,
            'tablet' => '/'.$tablet,
            'phone' => '/'.$phone,
        ]);
        $image->user()->associate(Auth::id())->save();
        return $image;
    }
}
