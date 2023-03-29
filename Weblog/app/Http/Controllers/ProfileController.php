<?php

namespace App\Http\Controllers;

use App\Models\Artical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //this controller prop should be renammed since the profile page is a bit weird so the names don't make much sense
    //for a normal resource controller

    //show profile
    public function index()
    {
        return view("profile/index");
    }

    //show articals 
    public function edit()
    {
        //get writen articals by user 
        $articals = Artical::where("author_id", "=", auth() -> user() -> id) -> get();

        //load page
        return view("profile/edit", ["articals" => $articals]);
    }
}
