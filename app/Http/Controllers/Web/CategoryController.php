<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller as Controller;
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
        return View('category.index')->with('categories', $categories);
    }

    /**
     * @param $id
     * @return Post
     */
    public function show(Request $request, $id) {
        $category = Category::findOrFail((int)$id);
        return View('category.show')->with('category', $category);
    }
}
