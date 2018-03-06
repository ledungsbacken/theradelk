<?php

namespace App\Http\Controllers\Web;

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
}
