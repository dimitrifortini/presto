<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Article;

class CartController extends Controller
{

   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $carts=Cart::where("user_id",auth()->id())->get();
        
        return view("cart.index",compact("carts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Article $article)
    {
        $cart = Cart::where("article_id", $article->id)->where("user_id", auth()->id())->first();
        if ($cart) {

            $cart->quantity += $request->quantity;
            $cart->save();
        }else{
            
            Cart::create([
                "user_id"=>auth()->id(),
                "article_id"=>$article->id,
                "quantity"=> $request->quantity,

            ]);
            
        }
        
        return redirect()->back();
    }

   

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $cart->update([
            "quantity"=>$request->quantity
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
          if (auth()->id() !== $cart->user_id) {
       abort(403);
    } 
        $cart->delete();
        return redirect()->back();
    }
}
