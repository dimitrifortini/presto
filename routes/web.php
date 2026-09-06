<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;

Route::get('/', [PublicController::class, ("home")])->name("home");
// ARTICLE
Route::get("/articles/create",[ArticleController::class,("create")])->name("article.create")->middleware("auth");
Route::get("/article/index",[ArticleController::class,("index")])->name("article.index");
Route::get("/article/show/{article}",[ArticleController::class,("show")])->name("article.show");
Route::get("/article/category/{category}",[ArticleController::class,("byCategory")])->name("article.category");
Route::get("/article/my_article",[ArticleController::class,("myArticle")])->name("article.my_article")->middleware("auth");
Route::get("/article/my_article/show/{article}",[ArticleController::class,("myArticleShow")])->name("article.my_article_show");
Route::get("/article/my_article/edit/{article}",[ArticleController::class,("edit")])->name("article.edit")->middleware("auth");
Route::delete("/article/my_article/delete/{article}",[ArticleController::class,("delete")])->name("article.delete")->middleware("auth");
// REVISOR
Route::get("/revisor/index",[RevisorController::class,("index")])->name("revisor.index")->middleware("isRevisor");
Route::patch("/accept/{article}",[RevisorController::class,("accept")])->name("accept");
Route::patch("/reject/{article}",[RevisorController::class,("reject")])->name("reject");
// MAIL
Route::get("/revisor/request",[RevisorController::class,("becomeRevisor")])->name("become.revisor")->middleware("auth");
Route::get("/make/revisor/{user}",[RevisorController::class,("makeRevisor")])->name("make.revisor");
// SEARCH
Route::get("/search/article",[PublicController::class,("searchArticles")])->name("article.search");
// SET LANG 
Route::post("/lingua/{lang}",[PublicController::class,"setLanguage"])->name("setLocale");