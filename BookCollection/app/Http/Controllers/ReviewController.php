<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    //get all reviews
    public function getReviews()
    {
        $reviews = Review::all();
        return response() -> json($reviews);
    }

    //add new review to DB
    public function addReview(AddReviewRequest $request)
    {
        $validated = $request -> validated();

        //make DB entry
        Review::create($validated);

        //load new data in
        $reviews = Review::all();
        return response() -> json($reviews);
    }

    //update book in DB
    public function updateReview(UpdateReviewRequest $request, Review $review)
    {
        $validated = $request -> validated();

        //update DB entry
        $review -> update($validated); 

        //load new data in
        $reviews = Review::all();
        return response() -> json($reviews);
    }

    public function deleteReview(Review $review)
    {
        //delete DB entry
        $review -> delete();

        //load new data in
        $reviews = Review::all();
        return response() -> json($reviews);
    }
}