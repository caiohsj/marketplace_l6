<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = $request->get('product');
        if (session()->has('cart')) {
            session()->push('cart', $product);
        } else {
            $cart[] = $product;
            session()->put('cart', $cart);
        }
        flash('Produto adicionado ao carrinho')->success();
        return redirect()->route('cart.index');
    }

    public function index()
    {
        if (session()->has('cart')) {
            $products = session()->get('cart');
        } else {
            $products = [];
        }
        return view('cart', compact('products'));
    }

    public function remove($slug)
    {
        $products = session()->get('cart');
        $products = array_filter($products, function ($row) use ($slug){
            return $row['slug'] != $slug;
        });
        session()->put('cart', $products);
        return redirect()->route('cart.index');
    }
}
