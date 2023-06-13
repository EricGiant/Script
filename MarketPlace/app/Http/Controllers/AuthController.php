<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthRequest;

class AuthController extends Controller
{
    //log user in
    public function store(StoreAuthRequest $request)
    {
        //get validated data
        $validated = $request -> validated();

        //try log user in
        if(auth() -> attempt($validated))
        {
            //redirect to home page
            return redirect("/post");
        }
        else
        {
            //redirect back to login page
            return back() -> withErrors(["password" => "password is invalid"]) -> withInput($validated);
        }
    }

    //log user out
    public function destroy()
    {
        //log user out
        auth() -> logout();

        //return to home page
        return redirect("/post");
    }
}
