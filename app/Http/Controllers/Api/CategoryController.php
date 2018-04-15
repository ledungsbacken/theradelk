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

        $request->slug = str_replace([' ', 'å', 'ä', 'ö', 'Å', 'Ä', 'Ö'], ['-', 'a', 'a', 'o', 'A', 'A', 'O'], strtolower($request->name));
        $category = Category::create($request->all());

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
        $category->update($request->all());

        return $category;
    }
}
