<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function index(){
        $orders= Order::orderBy("created_at","asc")->get();
        return view("admin.index",compact("orders"));
    }

    public function update(Order $order,Request $request ){
    $request->validate(["status" => "required|in:pending,confirmed,shipped,delivered,cancelled"]);  
   if ($order->status == "cancelled") {

} elseif ($request->status == "cancelled") {
    $order->update([
        "cancelled_at" => now(),
    ]);
} elseif ($request->status != "cancelled") {
    $order->update([
        "cancelled_at" => null,
    ]);
}
    $order->update([
        "status"=>$request->status,
        ]);
        return redirect()->route("admin.index");
        }
}