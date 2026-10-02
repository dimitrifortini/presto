<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Category;


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

    public function myArticleShow(Article $article)
    {
        if (auth()->id() !== $article->user_id && !auth()->user()->is_admin) {
            abort(403);
        }
        $reviews = $article->reviews()->latest()->get();

        return view("article.my_article_show", compact("article","reviews"));
    }
    public function edit(Article $article)
    {
        if (auth()->id() !== $article->user_id && !auth()->user()->is_admin) {

            abort(403);
        }

        return view("article.edit", compact("article"));
    }

    public function delete(Article $article)
    {
        if (auth()->id() !== $article->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        $article->delete();

        return redirect()
            ->route("article.my_article")
            ->with("message", __("ui.delete_article"));
    }

    public function index()
    {
        $articles = Article::where("is_accepted", true)->orderBy("created_at", "desc")->paginate(6);
        return view("article.index", compact("articles"));
    }

    public function show(Article $article)
    {
        $reviews = $article->reviews()->latest()->get();
        return view("article.show", compact("article", "reviews"));
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles->where("is_accepted", true);
        return view("article.category", compact("articles", "category"));
    }
}
