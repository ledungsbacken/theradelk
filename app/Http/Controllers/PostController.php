<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Post;

class PostController extends Controller
{
    public function index(Request $request) {
        $posts = Post::with(['subcategories.category', 'user'])
                     ->where([
                         ['hidden', '0'],
                         ['published', '0'],
                     ])
                     ->orderBy('id', 'DESC')
                     ->get();
        return $posts;
    }

    public function show($id) {
        $post = Post::with(['subcategories.category', 'user'])->find((int)$id);
        return $post;
    }

    public function store(Request $request) {
        $post = Post::create($request->all());
        $post->user()->associate(Auth::id())->save();
        return $post->load('user');
    }

    public function update(Request $request, $id) {
        $post = Post::find((int)$id);
        $post->update($request->all());
        return $post;
    }

    public function destroy($id) {
        $post = Post::find((int)$id);
        $post->delete();
        return $post;
    }
}
