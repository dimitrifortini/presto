<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Article $article)
    {
       

        Review::create(
            [
                "content" => $request->content,
                "reviewer_id" => auth()->id(),
                "article_id" => $article->id,
                "rating" => $request->rating,
            ]
        );
        return redirect()->back()->with("message", "Grazie per la tua recensione");
    }

   

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Article $article, Review $review)
{
    $request->validate([
        'content' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $review->update([
        'content' => $request->content,
        'rating' => $request->rating,
    ]);

    return redirect()
        ->back()
        ->with('success', 'Recensione modificata con successo.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Review $review)
{
    if (auth()->id() !== $review->reviewer_id) {
        abort(403);
    }

    $review->delete();

    return redirect()->back()
        ->with('success', 'Recensione eliminata con successo.');
}
}
