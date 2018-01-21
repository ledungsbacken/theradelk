<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Post;

class PostController extends Controller
{

    /**
     * @param Request $request
     * @return Post
     */
    public function index(Request $request) {
        $posts = Post::with(['subcategories.category', 'user'])
                     ->where([
                         ['hidden', '0'],
                         ['published', '0'],
                     ])
                     ->orderBy('id', 'DESC')
                     ->paginate((int)$request['count']);
        return $posts;
    }

    /**
     * @param $id
     * @return Post
     */
    public function show($id) {
        $post = Post::with(['subcategories.category', 'user'])->find((int)$id);
        return $post;
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function store(Request $request) { // TODO unset published
        $slug = str_replace([' ', 'å', 'ä', 'ö', 'Å', 'Ä', 'Ö'], ['-', 'a', 'a', 'o', 'A', 'A', 'O'], strtolower($request->title));
        $post = Post::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'slug' => $slug,
        ]);
        $post->user()->associate(Auth::id())->save();
        return $post->load('user');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Post
     */
    public function update(Request $request, $id) {
        $post = Post::find((int)$id);
        $post->update($request->all());
        return $post;
    }

    /**
     * @param Request $request
     * @param $id
     * @return Post
     */
    public function visibiltyStatus(Request $request, $id) {
        $published = (int)$request->published;
        if($published == 0 || $published == 1) {
            $post = Post::find((int)$id);
            $post->update([
                'published' => (int)$request->published
            ]);
            return $post;
        }
        return false;
    }

    /**
     * @param $id
     * @return Post
     */
    public function destroy($id) {
        $post = Post::find((int)$id);
        $post->delete();
        return $post;
    }

    /**
     * @param $id
     * @return Post
     */
    public function restoreDestroyed($id) {
        $post = Post::withTrashed()->find((int)$id);
        $post->restore();
        return $post;
    }

    /**
     * @param $id
     * @return Post
     */
    public function hardDelete($id) {
        $post = Post::withTrashed()->find((int)$id);
        $post->forceDelete();
        return $post;
    }
}
