<?php

namespace App\Http\Controllers;


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

        if (!$dummy->successful()) {
            return redirect()->back()->with("error_message", "Importazione non riuscita.");
        }

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

            if (!isset($categoryMap[$product["category"]])) {
                continue;
            }

            $categoryName = $categoryMap[$product["category"]];

            $category = Category::where("name", $categoryName)->first();

            if (!$category) {
                continue;
            }

            $article = Article::create([
                "title" => $product["title"],
                "description" => $product["description"],
                "price" => $product["price"],
                "category_id" => $category->id,
                "thumbnail" => $product["thumbnail"],
            ]);

            $article->user_id = null;
            $article->is_accepted = true;
            $article->revisor_id = null;
            $article->save();

            foreach ($product["images"] as $image) {
                $imageModel = Image::create([
                    "path" => $image,
                ]);

                $imageModel->article_id = $article->id;
                $imageModel->save();
            }

            foreach ($product["reviews"] as $review) {
                $reviewModel=Review::create([
                    "content" => $review["comment"],
                    "reviewer_id" => null,
                    "reviewer_name" => $review["reviewerName"],                    
                    "rating" => $review["rating"],
                ]);
                $reviewModel->article_id = $article->id;
                $reviewModel->save();
            }
        }
    }
}