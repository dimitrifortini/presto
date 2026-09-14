<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\UserController;

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
// REVIEW
Route::post("/article/{article}/review/store",[ReviewController::class,("store")])->name("review.store");
Route::put("/article/{article}/review/{review}/update",[ReviewController::class,("update")])->name("review.update");
Route::delete("/review/{review}/destroy",[ReviewController::class,("destroy")])->name("review.destroy");
// CART
Route::post("/cart/{article}",[CartController::class,("store")])->name("cart.store")->middleware("auth");
Route::delete("/cart/{cart}/destroy",[CartController::class,("destroy")])->name("cart.destroy")->middleware("auth");
Route::get("/cart/index",[CartController::class,("index")])->name("cart.index")->middleware("auth");
//ORDER
Route::get("/order/show/{order}",[OrderController::class,("show")])->name("order.show")->middleware("auth");
Route::post("/order/store",[OrderController::class,("store")])->name("order.store")->middleware("auth");
Route::get("/order/create",[OrderController::class,("create")])->name("order.create")->middleware("auth");

// REVISOR
Route::get("/revisor/index",[RevisorController::class,("index")])->name("revisor.index")->middleware("isRevisor");
Route::patch("/accept/{article}",[RevisorController::class,("accept")])->name("accept")->middleware("isRevisor");
Route::patch("/reject/{article}",[RevisorController::class,("reject")])->name("reject")->middleware("isRevisor");
Route::patch("/undo/{article}",[RevisorController::class,("undo")])->name("undo")->middleware("isRevisor");
//USER PROFILE
Route::get("/user/profile",[UserController::class,("profile")])->name("user.profile")->middleware("auth");
Route::get("user/profile/my_orders",[UserController::class,("orders")])->name("user.orders")->middleware("auth");
Route::get("user/profile/my_reviews",[UserController::class,("reviews")])->name("user.reviews")->middleware("auth");
Route::put("/user/profile/update",[UserController::class,("update")])->name("user.update");

// MAIL
Route::get("/revisor/request",[RevisorController::class,("becomeRevisor")])->name("become.revisor")->middleware("auth");
Route::get("/make/revisor/{user}",[RevisorController::class,("makeRevisor")])->name("make.revisor");
// SEARCH
Route::get("/search/article",[PublicController::class,("searchArticles")])->name("article.search");
// SET LANG 
Route::post("/lingua/{lang}",[PublicController::class,"setLanguage"])->name("setLocale");