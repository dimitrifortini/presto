<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy("created_at", "asc")->get();
        return view("admin.index", compact("orders"));
    }

    public function update(Order $order, Request $request)
    {
        $request->validate([
            "status" => "required|in:pending,confirmed,shipped,delivered,cancelled"
        ]);

        if ($request->status != "cancelled") {
            $order->cancelled_at = null;
        } 
        elseif ($order->status == "cancelled") {
            
        }
        elseif ($request->status == "cancelled") {
            $order->cancelled_at = now();
        } 

        $order->status = $request->status;
        $order->save();

        return redirect()->route("admin.index");
    }
}
