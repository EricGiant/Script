<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
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
    public function store(StoreUserRequest $request)
    {
        //validate entry
        $validated = $request -> validated();

        //save entry to DB
        $user = new User($validated);
        $user -> save();
        
        //log user in
        auth() -> login($user);

        //redirect to index
        return redirect("/");
    }

    //login user
    // TODO: maak AuthController waar de store functie een user inlogt. De UserController/store kan dan een nieuwe user opslaan. Dit is een logischere indeling.:
    //moet ik dit ook doen in mijn andere project?, in mijn andere project doet de login controller ook het user aanmaken dus moet dat dan in de user controller?
}
