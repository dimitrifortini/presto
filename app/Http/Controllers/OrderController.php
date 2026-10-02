<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_item;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "shipping_address" => "required|string|max:255",
            "payment_method" => "required|string",
        ]);
        $total = 0;
        $carts = Cart::where("user_id", auth()->id())->get();
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index');
        }
        foreach ($carts as $cart) {
            $multiply = $cart->article->price * $cart->quantity;
            $total += $multiply;
        };

        $order = new Order([
            
            
            "shipping_address" => $request->shipping_address,
            "payment_method" => $request->payment_method,
        ]);
        $order->total=$total;
        $order->user_id=auth()->id();
        $order->save();

        foreach ($carts as $cart) {
           $orderItem=new Order_item([               
                
                "quantity" => $cart->quantity,
                "price" => $cart->article->price,
            ]);
            $orderItem->order_id=$order->id;
            $orderItem->article_id=$cart->article->id;
            $orderItem->save();
        }

        Cart::where("user_id", auth()->id())->delete();

        return redirect()->route("order.index");
    }

    public function index()
    {
        $orders = Order::where("user_id", auth()->id())->orderBy("created_at", "desc")->get();
        return view("order.index", compact("orders"));
    }
    public function create()
    {
        $carts = Cart::where("user_id", auth()->id())->get();
        if ($carts->isEmpty()) {
            return redirect()->route("cart.index")->with("message",__("ui.empty_cart"));
        }
        $total = 0;
        foreach ($carts as $cart) {
            $quantity = $cart->article->price * $cart->quantity;
            $total += $quantity;
        }
        return view("order.create", compact("carts", "total"));
    }
}
