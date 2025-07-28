<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('shop.cart',compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        $id=$product->id;

        if(isset($cart[$id])){
            $cart[$id]['quantity'] +=1;
        } else {
            $cart[$id] = [
                'name'=> $product->name,
                'price' => $product->price,
                'description' => $product->description,
                'quantity'=>1
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Product added to cart');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        unset($cart[$product->id]);

        session(['cart'=>$cart]);

        return back()->with('success', 'Product added to cart');
    }

}
