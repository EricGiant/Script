<?php

namespace App\Http\Controllers;

use App\Models\Artical;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //show profile
    public function index()
    {
        return view("profile/index");
    }

    //show articals 
    public function edit()
    {
        //get writen articals by user 
        // TODO: werk zoveel mogelijk via model relaties, dus auth()->user()->articles
        $articals = Artical::where("author_id", "=", auth() -> user() -> id) -> get();

        //sort on upload date aka inverse collection since most recent ID is the most recent post
        $articals = $articals -> reverse();

        //load page
        return view("profile/edit", ["articals" => $articals]);
    }

    //update user to become premium
    public function update()
    {
        //get user
        $user = User::find(auth() -> user() -> id);

        //update user
        $user -> isPremium = true;
        $user -> save();

        //redirect to manage articals page
        return redirect("/profileIndex");

    }
}
