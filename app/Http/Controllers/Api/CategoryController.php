<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Auth;

use App\Category;
use App\Scenery;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return Category
     */
    public function index(Request $request) {
        $categories = Category::orderBy('name', 'ASC');
        if($request->get('sceneries')) {
            $categories->with('scenery');
        }
        $categories = $categories->get();
        return $categories;
    }

    /**
     * @param $id
     * @return Post
     */
    public function show(Request $request, $id) {
        $category = Category::with('scenery')->findOrFail((int)$id);
        return $category;
    }

    /**
     * @param Request $request
     * @return Category
     */
    public function store(Request $request) {
        // Return 403 if not enough permissions
        if(!Auth::user()->hasPermission('full')) { return response()->json('Forbidden', 403); }

        $slug = $request->name ? getSlug($request->name) : getSlug(uniqid(rand(1, 100)));
        $category = Category::create([
            'slug' => $slug,
            'name' => $request->name,
        ]);

        Scenery::create([
            'category_id' => $category->id,
        ]);

        return $category;
    }

    /**
     * @param Request $request
     * @return Category
     */
    public function update(Request $request, $id) {
        // Return 403 if not enough permissions
        if(!Auth::user()->hasPermission('full')) { return response()->json('Forbidden', 403); }

        $category = Category::find($id);
        $slug = $request->name ? getSlug($request->name) : getSlug(uniqid(rand(1, 100)));
        $category->update([
            'slug' => $slug,
            'name' => $request->name,
        ]);

        return $category;
    }
}
