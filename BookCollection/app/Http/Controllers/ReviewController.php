<?php

namespace App\Http\Controllers;

use App\Models\Review;

class ReviewController extends Controller
{
    //get all reviews
    public function getReviews()
    {
        $reviews = Review::all();
        return response() -> json($reviews);
    }
}