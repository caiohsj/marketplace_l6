<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    public function single($slug)
    {
        $store = Store::whereSlug($slug)->first();
        return view('store', compact('store'));
    }
}
