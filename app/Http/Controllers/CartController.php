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
        return redirect()->route('cart.home');
    }

    public function index()
    {
        $products = session()->get('cart');
        return view('cart', compact('products'));
    }
}
