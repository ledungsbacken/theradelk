<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Category;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return Category
     */
    public function index(Request $request) {
        $categories = Category::orderBy('name', 'ASC')->get();
        return $categories;
    }

    /**
     * @param $id
     * @return Post
     */
    public function show(Request $request, $id) {
        $category = Category::findOrFail((int)$id);
        return $category;
    }

    /**
     * @param Request $request
     * @return Category
     */
    public function store(Request $request) {
        // Return 403 if not enough permissions
        if(!Auth::user()->hasPermission('full')) { return response()->json('Forbidden', 403); }

        $category = Category::create($request->all());
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
