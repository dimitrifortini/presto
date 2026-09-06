<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class PublicController extends Controller
{
    public function home()
    {
        $articles = Article::where("is_accepted", true)->orderBy("created_at", "desc")->take(9)->orderBy("created_at", "desc")->get();
        return view('welcome', compact("articles"));
    }
    // PER DOCENTE: con il metodo commentato mi andava in errore Scout,sembra sia per colpa del metodo where() 
    // public function searchArticles(Request $request){
    // $query=$request->input("query");
    // $articles =Article::search($query)->where("is_accepted",true)->paginate(6);
    // return view("article.searched",compact("articles","query"));
    // }

    public function searchArticles(Request $request)
    {
        $query = $request->input("query");


        $ids = Article::search($query)->keys();

        $articles = Article::whereIn('id', $ids)
            ->where('is_accepted', true)
            ->paginate(6);

        return view("article.searched", compact("articles", "query"));
    }

    public function setLanguage($lang){
        session()->put("locale",$lang);
        return redirect()->back();
    }
}
