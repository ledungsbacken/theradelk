<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\SocialLink;
use App\SocialLinkType;

class SocialLinkTypeController extends Controller
{
    /**
     * @param Request $request
     * @return SocialLinkType
     */
    public function index(Request $request) {
        return SocialLinkType::all();
    }
}