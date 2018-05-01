<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Role;
use App\Post;
use App\Category;
use App\View;
use App\Scenery;

class PostController extends Controller
{

    /**
     * @param Request $request
     * @return Post
     */
    public function index(Request $request) {
        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);
        $posts->where('published', '=', '1');
        $posts->where('hidden', '=', '0');
        $posts->orderBy('id', 'DESC');

        $posts = $posts->paginate((int)$request['count']);

        $scenery = Scenery::whereNull('category_id')->first();

        return View('post.index', ['posts' => $posts, 'scenery' => $scenery]);
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function indexByCategory(Request $request, $categorySlug) {
        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);
        $category = Category::where('slug', '=', $categorySlug)->first();
        $posts->whereHas('subcategories.category', function($query) use ($categorySlug) {
            return $query->where('slug', '=', $categorySlug);
        });
        $posts->where('published', '=', '1');
        $posts->where('hidden', '=', '0');
        $posts->orderBy('id', 'DESC');

        $posts = $posts->paginate((int)$request['count']);

        $scenery = Scenery::where('category_id', '=', $category->id)->first();

        return View('post.index', ['posts' => $posts, 'scenery' => $scenery]);
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function indexBySubcategory(Request $request, $categorySlug, $subcategorySlug) {
        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);
        $category = Category::where('slug', '=', $categorySlug)->first();
        $posts->whereHas('subcategories', function($query) use ($category, $subcategorySlug) {
            return $query->where([
                ['slug', '=', $subcategorySlug],
                ['category_id', '=', $category->id],
            ]);
        });
        $posts->where('published', '=', '1');
        $posts->where('hidden', '=', '0');
        $posts->orderBy('id', 'DESC');

        $posts = $posts->paginate((int)$request['count']);

        return View('post.index')->with('posts', $posts);
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function indexByUser(Request $request, $userId) {
        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);
        $posts->where('published', '=', '1');
        $posts->where('user_id', '=', (int)$userId);
        $posts->orderBy('id', 'DESC');

        $posts = $posts->paginate((int)$request['count']);

        return View('post.index')->with('posts', $posts);
    }

    /**
     * @param $id
     * @return Post
     */
    public function show(Request $request, $slug) {
        $post = Post::with(['subcategories.category', 'user', 'headImage'])->where('slug', '=', $slug)->firstOrFail();
        if($post->published == 1) {
            View::create([
                'post_id' => $post->id,
            ]);
        } else {
            if(Auth::check()) {
                // Return 404 if not enough permissions
                if(Auth::user()->cant('update', $post)) { return response()->json('Not Found.', 404); }
            } else {
                return response()->json('Not Found', 404);
            }
        }
        $relatedPosts = Post::with(['user', 'headImage']);
        if($post->subcategories->count() > 0) {
                $relatedPosts->whereHas('subcategories', function($query) use ($post) {
                        return $query->where('category_id', '=', $post->subcategories[0]->category_id);
                });
        }

        $relatedPosts->where('published', '=', '1');
        $relatedPosts->where('hidden', '=', '0');

        $relatedPosts = $relatedPosts->inRandomOrder()->limit(2)->get();

        $count = file_get_contents('https://graph.facebook.com/?id='.$request->fullUrl());

        return view('post.show',
            [
                'post' => $post->load('viewsCountRelation'),
                'relatedPosts' => $relatedPosts,
                'sharesCount' => $count,
            ]
        );
    }
}
