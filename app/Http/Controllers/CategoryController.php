<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function single($slug)
    {
        $category = Category::whereSlug($slug)->first();
        return view('category', compact('category'));
    }
}
