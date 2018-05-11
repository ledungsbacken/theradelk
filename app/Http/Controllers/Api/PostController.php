<?php

namespace App\Http\Controllers\Api;

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
        if(isset($request['category'])) {
            $categorySlug = $request['category'];
            if(isset($request['subcategory'])) {
                $category = Category::where('slug', '=', $categorySlug)->first();
                $subcategory_slug = $request['subcategory'];
                $posts->whereHas('subcategories', function($query) use ($category, $subcategory_slug) {
                    return $query->where([
                        ['slug', '=', $subcategory_slug],
                        ['category_id', '=', $category->id],
                    ]);
                });
            } else {
                $posts->whereHas('subcategories.category', function($query) use ($categorySlug) {
                    return $query->where('slug', '=', $categorySlug);
                });
            }
        }
        if(isset($request['user_id'])) {
            $posts->where('user_id', '=', (int)$request['user_id']);
        } else {
            $posts->where('hidden', '=', '0');
        }
        $posts->whereNotNull('published');
        if(isset($request['sortBy']) && isset($request['sortOrder'])) {
            $posts->orderBy($request['sortBy'], $request['sortOrder']);
        } else {
            $posts->orderBy('id', 'DESC');
        }
        $request['page'] = $request['page'] + (((int)$request['count'] * 3) / (int)$request['count']);
        $posts = $posts->paginate((int)$request['count']);

        return $posts;
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function indexByCategory(Request $request) {
        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);

        if($request['category_id']) {
            $categoryId = $request['category_id'];
            $posts->whereHas('subcategories.category', function($query) use ($categoryId) {
                return $query->where('id', '=', $categoryId);
            });
        }

        $posts->where('hidden', '=', '0');
        $posts->whereNotNull('published');
        $posts->orderBy('id', 'DESC');

        $posts = $posts->get();

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
        if($post->published) {
            if($request->add_view) {
                View::create([
                    'post_id' => $post->id,
                ]);
            }
        } else {
            if(Auth::check()) {
                // Return 404 if not enough permissions
                if(Auth::user()->cant('update', $post)) { return response()->json('Not Found.', 404); }
            } else {
                return response()->json('Not Found', 404);
            }
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
            'opacity' => $request->opacity,
            'is_fullscreen' => $request->is_fullscreen ? $request->is_fullscreen : false,
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
            'opacity' => $request->opacity,
            'is_fullscreen' => $request->is_fullscreen,
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
                'published' => $published == 1 ? date('Y-m-d H:i:s') : null
            ]);
            if($post->published == 1) {
                $user = User::with('roles')->find($post->user_id);
                $isNoob = false;
                $superAdmin = null;
                $user->roles->each(function($role) use (&$isNoob, &$superAdmin) {
                    if($role->name == 'noob') {
                        $isNoob = true;
                    }
                    if($role->name == 'super_admin') {
                        $superAdmin = $role;
                    }
                });
                if($isNoob) {
                    $roles = [];
                    if($superAdmin) {
                        $roles[] = $superAdmin->id;
                    }
                    $editor = Role::where('name', '=', 'editor')->first();
                    $roles[] = $editor->id;
                    $user->roles()->sync($roles);
                }
            }
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
