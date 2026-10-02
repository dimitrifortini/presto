<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = Review::where("reviewer_id", auth()->id())->orderBy("updated_at", "desc")->get();
        return view("review.index", compact("reviews"));
    }

    public function store(Request $request, Article $article)
    {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $reviewModel = Review::create(
            [
                "content" => $request->content,
                "rating" => $request->rating,
            ]
        );
        $reviewModel->article_id = $article->id;
        $reviewModel->reviewer_id = auth()->id();
        $reviewModel->save();
        return redirect()->back()->with("reviewMessage", __('ui.thank_you_for_review'));
    }




    public function update(Request $request, Article $article, Review $review)
    {
        if (auth()->id() !== $review->reviewer_id) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string',
            'rating' => 'numeric|min:1|max:5',
        ]);

        $review->update([
            'content' => $request->content,
            'rating' => $request->rating ?? $review->rating,
        ]);
       

        return redirect()
            ->back()
            ->with('success', __("ui.review_update"));
    }


    public function destroy(Review $review)
    {
        if (auth()->id() !== $review->reviewer_id) {
            abort(403);
        }

        $review->delete();

        return redirect()->back()
            ->with('success', __("ui.review_delete"));
    }
}
