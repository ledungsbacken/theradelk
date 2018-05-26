<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Auth;

use App\Subcategory;
use App\Category;

class SubcategoryController extends Controller
{
    /**
     * @param Request $request
     * @return Post
     */
    public function index(Request $request) {
        $subcategories = Subcategory::with(['category'])
                     ->orderBy('name', 'ASC')
                     ->get();
        return $subcategories;
    }

    /**
     * @param Request $request
     * @return Post
     */
    public function indexByCategory(Request $request, $id) {
        $subcategories = Subcategory::where('category_id', '=', (int)$id)->orderBy('name', 'ASC')->get();
        return $subcategories;
    }

    /**
     * @param Request $request
     * @return Subcategory
     */
    public function store(Request $request) {
        // Return 403 if not enough permissions
        if(!Auth::user()->hasPermission('full')) { return response()->json('Forbidden', 403); }

        $slug = $request->name ? getSlug($request->name) : getSlug(uniqid(rand(1, 100)));
        $subcategory = Subcategory::create([
            'slug' => $slug,
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);
        return $subcategory;
    }

    /**
     * @param Request $request
     * @return Subcategory
     */
    public function update(Request $request, $id) {
        // Return 403 if not enough permissions
        if(!Auth::user()->hasPermission('full')) { return response()->json('Forbidden', 403); }

        $subcategory = Subcategory::find($id);
        $slug = $request->name ? getSlug($request->name) : getSlug(uniqid(rand(1, 100)));
        $subcategory->update([
            'slug' => $slug,
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        return $subcategory;
    }
}
