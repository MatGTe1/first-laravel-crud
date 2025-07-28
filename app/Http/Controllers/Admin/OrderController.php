<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['user','products'])->get();

        return view('admin.order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $products= Product::all();

        return view('admin.order.create', compact('users','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'products'=>'required|array',
            'products.*'=>'exists:products,id',
            'status'=>'required|string',
            'selectedQuantities'=> 'required|array',
            'selectedQuantities.*' => 'integer|min:1'
        ]);

        $selectedQuantities=$request->selectedQuantities;

        $order = Order::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
        ]);
        
        foreach($request->products as $productId)
        {
            if(isset($selectedQuantities[$productId])){
                $quantity= $request->selectedQuantities[$productId];

                $product = Product::findOrFail($productId); 
                $product->quantity-=$quantity; 
                $product->save();

                $order->products()->attach($productId, ['quantity'=> $quantity]);
                
            }
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $users = User::all();
        $products = Product::all();

        foreach($products as $product){
            $existingOrderQuantitiy = $order->products->firstWhere('id',$product->id)?->pivot->quantity ?? 0;
            $product->avaibleQuantity = $product->quantity + $existingOrderQuantitiy;
        }

        return view('admin.order.edit', compact('order','users', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array', //id of products
            'products.*' => 'exists:products,id',
            'status' => 'required|string',
            'selectedQuantities' => 'required|array', //id_product => quantity
            'selectedQuantities.*' => 'integer|min:1'
        ]);

        foreach($order->products as $product){
            $product->quantity+=$product->pivot->quantity; 
            $product->save();
        }

        $order->products()->detach();

        $syncData = [];

        foreach($request->products as $productId){
            $quantity = $request->selectedQuantities[$productId] ?? 1;

            $product = Product::findOrFail($productId);

            if ($product->quantity < $quantity) {
                return back()->withErrors(['Product ' . $product->name . ' not enough in storage.']);
            }

            $product->quantity -= $quantity;
            $product->save();

            $syncData[$productId] = ['quantity' => $quantity];
        }

        $order->update([
            'user_id' => $request->user_id,
            'status' => $request->status,
        ]);

        $order->products()->sync($syncData);

        return redirect()->route('admin.orders.index')->with('success', 'Order updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted.');
    }
}
