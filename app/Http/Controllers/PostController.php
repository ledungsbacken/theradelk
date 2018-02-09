<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Post;
use App\View;

class PostController extends Controller
{

    /**
     * @param Request $request
     * @return Post
     */
    public function index(Request $request) {
        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation'])
                     ->where([
                         ['hidden', '0'],
                         ['published', '1'],
                     ])
                     ->orderBy('id', 'DESC')
                     ->paginate((int)$request['count']);
        return $posts;
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function indexAdmin(Request $request) {
        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);
        if(Auth::user()->can('indexAll', Post::class)) {
            $posts = $posts->withTrashed();
        }
        if($request['showAll'] == 'true' && Auth::user()->can('indexAll', Post::class)) {

        } else {
            $posts = $posts->where('user_id', '=', Auth::user()->id);
        }
        $posts = $posts->orderBy('id', 'DESC')
                       ->paginate((int)$request['count']);
        return $posts;
    }

    /**
     * @param $id
     * @return Post
     */
    public function show(Request $request, $id) {
        $post = Post::with(['subcategories.category', 'user', 'headImage'])->findOrFail((int)$id);
        if($request->add_view) {
            View::create([
                'post_id' => $post->id,
            ]);
        }
        return $post->load('viewsCountRelation');
    }

    /**
     * @param $id
     * @return Post
     */
    public function showBySlug(Request $request, $slug) {
        $post = Post::with(['subcategories.category', 'user', 'headImage'])->where('slug', '=', $slug)->firstOrFail();
        if($request->add_view) {
            View::create([
                'post_id' => $post->id,
            ]);
        }
        return $post->load('viewsCountRelation');
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function store(Request $request) { // TODO unset published
        // Return 403 if not enough permissions
        if(Auth::user()->cant('create', Post::class)) { return response()->json('Forbidden', 403); }

        $slug = str_replace([' ', 'å', 'ä', 'ö', 'Å', 'Ä', 'Ö'], ['-', 'a', 'a', 'o', 'A', 'A', 'O'], strtolower($request->title));
        $post = Post::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'slug' => $slug,
        ]);
        $post->user()->associate(Auth::id())->save();
        $post->headImage()->associate((int)$request->head_image_id)->save();
        foreach($request->get('subcategories') as $subcategory) {
            $post->subcategories()->attach($subcategory['data']['id']);
        }

        return $post->load('subcategories.category', 'user', 'headImage');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Post
     */
    public function update(Request $request, $id) {
        $post = Post::find((int)$id);
        // Return 403 if not enough permissions
        if(Auth::user()->cant('update', $post)) { return response()->json('Forbidden', 403); }

        $slug = str_replace([' ', 'å', 'ä', 'ö', 'Å', 'Ä', 'Ö'], ['-', 'a', 'a', 'o', 'A', 'A', 'O'], strtolower($request->title));
        $post->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
            'slug' => $slug,
        ]);
        $post->headImage()->associate((int)$request->head_image_id)->save();
        $subcategories = [];
        foreach($request->get('subcategories') as $subcategory) {
            $subcategories[] = $subcategory['data']['id'];
        }
        $post->subcategories()->sync($subcategories);

        return $post->load('subcategories.category', 'user', 'headImage');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Post
     */
    public function setPublished(Request $request, $id) {
        $post = Post::find((int)$id);
        // Return 403 if not enough permissions
        if(Auth::user()->cant('delete', $post)) { return response()->json('Forbidden', 403); }

        $published = (int)$request->published;
        if($published == 0 || $published == 1) {
            $post->update([
                'published' => $published
            ]);
            return $post;
        }
        return false;
    }

    /**
     * @param Request $request
     * @param $id
     * @return Post
     */
    public function setHidden(Request $request, $id) {
        $post = Post::find((int)$id);
        // Return 403 if not enough permissions
        if(Auth::user()->cant('delete', $post)) { return response()->json('Forbidden', 403); }

        $hidden = (int)$request->hidden;
        if($hidden == 0 || $hidden == 1) {
            $post->update([
                'hidden' => (int)$request->hidden
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
        // Return 403 if not enough permissions
        if(Auth::user()->cant('delete', $post)) { return response()->json('Forbidden', 403); }

        $post->delete();
        return $post;
    }

    /**
     * @param $id
     * @return Post
     */
    public function restoreDestroyed($id) {
        $post = Post::withTrashed()->find((int)$id);
        // Return 403 if not enough permissions
        if(Auth::user()->cant('delete', $post)) { return response()->json('Forbidden', 403); }

        $post->restore();
        return $post;
    }

    /**
     * @param $id
     * @return Post
     */
    public function hardDelete($id) {
        $post = Post::withTrashed()->find((int)$id);
        // Return 403 if not enough permissions
        if(Auth::user()->cant('forceDelete', $post)) { return response()->json('Forbidden', 403); }

        if($post) {
            $post->subcategories->each(function($subcategory) use ($post) {
                $post->subcategories()->detach($subcategory->id);
            });
            View::where('post_id', '=', $post->id)->delete();
            $post->forceDelete();
        }
        return $post;
    }
}
