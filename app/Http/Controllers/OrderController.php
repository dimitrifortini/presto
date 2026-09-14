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
            "shipping_address" => "required",
            "payment_method" => "required",
        ]);
        $total = 0;
        $carts = Cart::where("user_id", auth()->id())->get();
        foreach ($carts as $cart) {
            $multiply = $cart->article->price * $cart->quantity;
            $total += $multiply;
        };

        $order = Order::create([
            "user_id" => auth()->id(),
            "total" => $total,
            "shipping_address" => $request->shipping_address,
            "payment_method" => $request->payment_method,
        ]);

        foreach ($carts as $cart) {
            Order_item::create([
                "order_id" => $order->id,
                "article_id" => $cart->article->id,
                "quantity" => $cart->quantity,
                "price" => $cart->article->price,
            ]);
        }

        Cart::where("user_id", auth()->id())->delete();
        return redirect()->route("order.show", $order->id);
    }

    public function show(Order $order)
    {
        return view("order.show", compact("order"));
    }
    public function create()
    {
        $carts = Cart::where("user_id", auth()->id())->get();

        $total = 0;
        foreach ($carts as $cart) {
            $quantity = $cart->article->price * $cart->quantity;
            $total += $quantity;
        }
        return view("order.create", compact("carts","total"));
    }
    
}
