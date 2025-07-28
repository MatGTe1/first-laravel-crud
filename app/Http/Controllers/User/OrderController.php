<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user','products'])->where('user_id',Auth::id())->get();

        return view('order.index',compact('orders'));
    }

    public function store()
    {
        $cart = session()->get('cart');

        if(!$cart || empty($cart))
        {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => "pending"
        ]);

        foreach($cart as $productId => $item)
        {
            $product = Product::find($productId);

            if($product && $item['quantity'] > 0)
            {
                $order->products()->attach($productId,['quantity'=>$item['quantity']]);
                
                $product->quantity -= $item['quantity'];
                $product->save();
            }
        }

        session()->forget('cart');

        return redirect()->route('shop.home')->with('success', 'Ordered.');
    }
}
