<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subcategory;
use App\Category;

class SubcategoryController extends Controller
{
    /**
     * @param Request $request
     * @return Post
     */
    public function index(Request $request) {
        $categories = Subcategory::with(['category'])
                     ->orderBy('name', 'ASC')
                     ->get();
        return $categories;
    }
}
