<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Http\Requests\StoreBidRequest;
use App\Http\Requests\UpdateBidRequest;

class BidController extends Controller
{
    //store new bid
    public function store(StoreBidRequest $request)
    {
        //get validated data
        $validated = $request -> validated();
        $validated["user_id"] = auth() -> user() -> id;

        //make bid
        $bid = new Bid($validated);
        $bid -> save();

        //return to page
        return back();
    }

    //show edit bid page
    public function edit()
    {
        //flash check to back page to load in the edit bid form
        return back() -> with("editBid", "1");   
    }

    //update bid
    public function update(UpdateBidRequest $request, Bid $bid)
    {
        //check if user made this bid
        $this -> authorize("update", $bid);

        //get validated data
        $validated = $request -> validated();

        //update bid
        $bid -> update($validated);

        //go back to post
        return back();
    }

    //remove bid
    public function destroy(Bid $bid)
    {
        //check if user made this bid
        $this -> authorize("delete", $bid);

        //delete bid
        $bid -> delete();

        //go back to post
        return back();
    }
}
