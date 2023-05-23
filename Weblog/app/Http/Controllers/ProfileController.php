<?php

namespace App\Http\Controllers;

use App\Models\Artical;
use App\Models\User;

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
        $articals = auth() -> user() -> articals;

        // TODO: chain reverse op voorgaande regel zodat je 1 regel code uitspaart
        //sort on upload date aka inverse collection since most recent ID is the most recent post
        $articals = $articals -> reverse();

        //load page
        return view("profile/edit", ["articals" => $articals]);
    }

    //update user to become premium
    public function update()
    {
        //get user
        $user = auth() -> user();

        //update user
        $user -> isPremium = true;
        $user -> save();

        //redirect to manage articals page
        return redirect("/profile");

    }
}
