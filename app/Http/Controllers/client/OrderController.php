<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;

use Illuminate\Http\Request;

class OrderController extends Controller
{



    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);

        return view('clients.orders.create', compact('categories', 'client', 'orders'));
    }
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);
        $total_price = 0;

        foreach($request->products as $id=>$quantity) {

            $product = Product::findOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update([

                'stock' => $product->stock - $quantity['quantity']
            ]);
        }
        $order->update([
            'total_price' => $total_price
        ]);
        session()->flash('Add');
        return redirect()->route('orders.index');
    } //end of store

}
