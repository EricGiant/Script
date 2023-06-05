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
        //get writen articals by user sorted on upload data (aka the last one in the list is the first one) 
        $articals = auth() -> user() -> articals -> reverse();

        //load page
        return view("profile/edit", ["articals" => $articals]);
    }

    //update user to become premium
    public function update()
    {
        //get user
        $user = auth() -> user();

        //update user
        $user -> update(["isPremium" => true]);

        //redirect to manage articals page
        return redirect("/profile");

    }
}
