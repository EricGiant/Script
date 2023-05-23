<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //show login page
    public function index()
    {
        return view("user/index");
    }

    //show create account page
    public function create()
    {
        return view("user/create");
    }

    //store new account in DB
    public function store(Request $request)
    {
        //validate entry
        $attributes = $request -> validate([
            "name" => "required|between:2,50|unique:users,name",
            "password" => "required|between:5,100",
            "email" => "email|unique:users,email"
        ]);

        //save entry to DB
        $user = new User($attributes);
        $user -> save();
        
        //log user in
        auth() -> login($user);

        //redirect to index
        return redirect("/");
    }

    //login user
    // TODO: maak AuthController waar de store functie een user inlogt. De UserController/store kan dan een nieuwe user opslaan. Dit is een logischere indeling.
    public function show(Request $request)
    {
        //check if data exists in DB
        $attributes = $request -> validate([
            "name" => "required|exists:users,name",
            "password" => "required",
            "email" => "email|exists:users,email"
        ]);

        if(auth() -> attempt($attributes))
        {
            //redirect to index
            return redirect("/");
        }
        else
        {
            //redirect to login page
            return back() -> withErrors(["password" => "password is invalid"]) -> withInput($attributes);
        }
    }

    //log user out
    // TODO: deze method kan naar de te maken AuthController/destroy method
    public function destroy()
    {
        //log user out
        auth() -> logout();

        //redirect to index
        return redirect("/");
    }
}
