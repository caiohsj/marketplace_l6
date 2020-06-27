<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = $request->get('product');
        if (session()->has('cart')) {
            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug');
            if (in_array($product['slug'], $productsSlugs)) {
                $cart = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart', $cart);
            } else {
                session()->push('cart', $product);
            }
            
        } else {
            $cart[] = $product;
            session()->put('cart', $cart);
        }
        flash('Produto adicionado ao carrinho')->success();
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        if (session()->has('cart')) {
            session()->forget('cart');
            flash('Compra Cancelada')->warning();
        }
        return redirect()->route('site');
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

    private function productIncrement($slug, $amount, $products)
    {
        $products = array_map(function ($row) use ($slug, $amount){
            if ($row['slug'] == $slug) {
                $row['amount'] += $amount;
            }
            return $row;
        }, $products);
        return $products;
    }
}
