<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;

class PostController extends Controller
{
    public function index(Request $request) {
        $posts = Post::with('subcategories.category')->get();
        return $posts;
    }

    public function show($id) {
        $post = Post::with('subcategories.category')->find((int)$id);
        return $post;
    }
}
