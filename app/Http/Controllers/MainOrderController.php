<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;

class MainOrderController extends Controller
{

    public function index(Request $request)
    {
        $orders = Order::whereHas('client', function ($q) use ($request) {

            return $q->where('name', 'like', '%' . $request->search . '%');
        })->paginate(5);

        return view('orders.index', compact('orders'));
    } //end of index

    public function products(Order $order)
    {
        $products = $order->products;
        return view('orders._products', compact('order', 'products'));
    } //end of products

    public function destroy(Order $order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);

        }//end of for each

        $order->delete();
        return redirect()->route('orders.index');
    
    }//end of order
}
