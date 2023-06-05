<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthRequest;

class AuthController extends Controller
{
    //log user in
    public function store(StoreAuthRequest $request)
    {
        //get validated data
        $validated = $request -> validate();

        //try to log in
        if(auth() -> attempt($validated))
        {
            //redirect to index
            return redirect("/");
        }
        else
        {
            //redirect to login page
            return back() -> withErrors(["password" => "password is invalid"]) -> withInput($validated);
        }
    }

    //log user out
    public function destroy($id)
    {
        //log user out
        auth() -> logout();

        //redirect to index
        return redirect("/");
    }
}
