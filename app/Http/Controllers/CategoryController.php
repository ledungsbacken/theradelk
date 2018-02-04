<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @param Request $request
     * @return Category
     */
    public function store(Request $request) {
        $category = Category::create($request->all());
        return $category;
    }

    /**
     * @param Request $request
     * @return Category
     */
    public function update(Request $request, $id) {
        $category = Category::find($id);
        $category->update($request->all());

        return $category;
    }
}
