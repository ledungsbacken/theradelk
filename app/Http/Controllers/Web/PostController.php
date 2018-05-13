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
    private $count = 9;

    /**
     * @param Request $request
     * @return Post
     */
    public function index(Request $request) {
        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);
        $posts->whereNotNull('published');
        $posts->where('hidden', '=', '0');
        $posts->orderBy('published', 'DESC');

        $posts = $posts->paginate($this->count);

        $scenery = Scenery::whereNull('category_id')->first();

        return View('post.index', ['posts' => $posts, 'scenery' => $scenery]);
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function indexLatest(Request $request) {
        $this->count = 9;

        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);
        $posts->whereNotNull('published');
        $posts->where('hidden', '=', '0');
        $posts->orderBy('published', 'DESC');

        $posts = $posts->paginate($this->count);

        return View('post.latest', ['posts' => $posts]);
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function indexByCategory(Request $request, $categorySlug) {
        $this->count = 12;

        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);
        $category = Category::where('slug', '=', $categorySlug)->first();
        $posts->whereHas('subcategories.category', function($query) use ($categorySlug) {
            return $query->where('slug', '=', $categorySlug);
        });
        $posts->whereNotNull('published');
        $posts->where('hidden', '=', '0');
        $posts->orderBy('published', 'DESC');

        $posts = $posts->paginate($this->count);

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
        $posts->whereNotNull('published');
        $posts->where('hidden', '=', '0');
        $posts->orderBy('published', 'DESC');

        $posts = $posts->paginate($this->count);

        $scenery = Scenery::where('category_id', '=', $category->id)->first();

        return View('post.index', ['posts' => $posts, 'scenery' => $scenery]);
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function search(Request $request) {
        if(!$request->q) {
            return Redirect('/');
        }
        $search = explode(' ', $request->q);
        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);
        $posts->whereNotNull('published');
        foreach($search as $word) {
            $posts->where(function($query) use ($word) {
                $query->orWhere('title', 'LIKE', '%'.$word.'%');
                $query->orWhere('subtitle', 'LIKE', '%'.$word.'%');
                $query->orWhere('content', 'LIKE', '%'.$word.'%');
            });
        }
        $posts->orderBy('published', 'DESC');

        $posts = $posts->paginate($this->count);

        return View('post.search', ['posts' => $posts]);
    }

    /**
     * @param $id
     * @return Post
     */
    public function show(Request $request, $slug) {
        $post = Post::with(['subcategories.category', 'user', 'headImage'])->where('slug', '=', $slug)->firstOrFail();
        if($post->published) {
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

        $relatedPosts->where('id', '!=', $post->id);
        $relatedPosts->whereNotNull('published');
        $relatedPosts->where('hidden', '=', '0');

        $limit = $post->is_fullscreen ? 2 : 3;
        $relatedPosts = $relatedPosts->inRandomOrder()->limit($limit)->get();

        $popularPosts = Post::with(['user', 'headImage'])->join('views', 'posts.id', '=', 'views.post_id');
        $popularPosts->where('views.created_at', '>=', \Carbon\Carbon::now()->subDays(1));
        $popularPosts->selectRaw('posts.*, COUNT(views.id) AS views_count')
                     ->groupBy('posts.id')
                     ->orderByRaw('views_count DESC');

        $popularPosts = $popularPosts->limit(2)->get();


        $count = file_get_contents('https://graph.facebook.com/?id='.$request->fullUrl());

        return view('post.show',
            [
                'post' => $post->load('viewsCountRelation'),
                'relatedPosts' => $relatedPosts,
                'popularPosts' => $popularPosts,
                'sharesCount' => $count,
            ]
        );
    }
}