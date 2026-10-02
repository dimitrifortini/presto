<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Article;

class CartController extends Controller
{



    public function index()
    {
        $carts = Cart::where("user_id", auth()->id())->get();

        return view("cart.index", compact("carts"));
    }



    public function store(Request $request, Article $article)
    {
        $request->validate([
            "quantity" => "required|integer|min:1",
        ]);
        $cart = Cart::where("article_id", $article->id)->where("user_id", auth()->id())->first();
        if ($cart) {

            $cart->quantity += $request->quantity;
            $cart->save();
        } else {

            $cart =new Cart([

                "article_id" => $article->id,
                "quantity" => $request->quantity,

            ]);
            $cart->user_id = auth()->id();
            $cart->save();
        }

        return redirect()->back();
    }

    public function destroy(Cart $cart)
    {
        if (auth()->id() !== $cart->user_id) {
            abort(403);
        }
        $cart->delete();
        return redirect()->back();
    }
}
