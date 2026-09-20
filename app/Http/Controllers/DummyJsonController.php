<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\Article;
use App\Models\Image;
use App\Models\Review;

class DummyJsonController extends Controller
{

    public function import()
    {
        $dummy = Http::get("https://dummyjson.com/products");
        $products = $dummy->json()["products"];
        $categoryMap = [
            "beauty" => "Salute e Bellezza",
            "fragrances" => "Salute e Bellezza",
            "skin-care" => "Salute e Bellezza",

            "sunglasses" => "Accessori",
            "mens-watches" => "Accessori",
            "womens-bags" => "Accessori",
            "womens-jewellery" => "Accessori",
            "womens-watches" => "Accessori",

            "mens-shirts" => "Abbigliamento",
            "mens-shoes" => "Abbigliamento",
            "tops" => "Abbigliamento",
            "womens-dresses" => "Abbigliamento",
            "womens-shoes" => "Abbigliamento",

            "laptops" => "Elettronica",
            "mobile-accessories" => "Elettronica",
            "smartphones" => "Elettronica",
            "tablets" => "Elettronica",

            "furniture" => "Casa e Giardinaggio",
            "home-decoration" => "Casa e Giardinaggio",
            "kitchen-accessories" => "Casa e Giardinaggio",

            "sports-accessories" => "Sport",

            "motorcycle" => "Motori",
            "vehicle" => "Motori",
        ];


        foreach ($products as $product) {

            if ($product["category"] === "groceries") {
                continue;
            }

            $categoryName = $categoryMap[$product["category"]];

            $category = Category::where("name", $categoryName)->first();

            $article = Article::create([
                "title" => $product["title"],
                "description" => $product["description"],
                "price" => $product["price"],
                "category_id" => $category->id,
                "user_id" => null,
                "is_accepted" => true,
                "revisor_id" => null,
                "thumbnail" => $product["thumbnail"],
            ]);
            foreach ($product["images"] as $image) {
                Image::create([
                    "path" => $image,
                    "article_id" => $article->id,
                ]);
            }
            foreach ($product["reviews"] as $review) {
                Review::create([
                    "content" => $review["comment"],
                    "reviewer_id" => null,
                    "reviewer_name" => $review["reviewerName"],
                    "article_id" => $article->id,
                    "rating" => $review["rating"],
                ]);
            }
        }
    }
}
