<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create()
    {
        return view("article.create");
    }
    public function myArticle()
    {
        $articles = Article::where("user_id", auth()->id())->get();
        return view("article.my_article", compact("articles"));
    }

    public function myArticleShow(Article $article){
        return view("article.my_article_show", compact("article"));

    }    
    public function edit(Article $article)
    {
        return view("article.edit", compact("article"));
    }

    public function delete(Article $article){
        $article->delete();
        return redirect()->route("article.my_article")->with("message","L'annuncio è stato eliminato correttamente!");
    }

    public function index()
    {
        $articles = Article::where("is_accepted", true)->orderBy("created_at", "desc")->paginate(6);
        return view("article.index", compact("articles"));
    }

    public function show(Article $article)
    {
        return view("article.show", compact("article"));
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles->where("is_accepted", true);
        return view("article.category", compact("articles", "category"));
    }
}
