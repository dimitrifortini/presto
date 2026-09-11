<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public Function profile(){

        return view("user.profile");

    }
     public function orders(){
        return view("user.my_order");
    }
    public function reviews(){
        return view("user.my_review");
    }
    public function update(Request $request){
        
        $request->validate([
            "name"=>"required",
            "email"=>"required|email"
        ]);
        $user=Auth::user();
        $user->update([
            "name"=> $request->name,
            "email"=> $request->email
        ]);
        // $user->save();
        return redirect()->route("user.profile");
    }
}
