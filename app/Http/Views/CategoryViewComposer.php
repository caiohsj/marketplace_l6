<?php
namespace App\Http\Views;

class CategoryViewComposer
{
    public function compose($view)
    {
        return $view->with('categories', \App\Category::all(['name', 'slug']));
    }
}