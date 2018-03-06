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

class PostController extends Controller
{

    /**
     * @param Request $request
     * @return Post
     */
    public function index(Request $request) {
        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);
        $posts->where('published', '=', '1');
        $posts->orderBy('id', 'DESC');

        $posts = $posts->paginate((int)$request['count']);

        return View('post.index')->with('posts', $posts);
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
        $posts->orderBy('id', 'DESC');

        $posts = $posts->paginate((int)$request['count']);

        return View('post.index')->with('posts', $posts);
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

        return view('post.show')->with('post', $post->load('viewsCountRelation'));
    }
}
