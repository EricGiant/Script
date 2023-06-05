<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePassword;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasswordController extends Controller
{
    //show new password page
    public function edit($token)
    {
        //check if token is valid
        $entry = DB::table("password_resets") -> where("token", $token) -> get() -> first();
        if($entry == null)
        {
            return "<p style = 'text-align: center; margin-top: 40px; font-weight: bolder; font-size: 30px'>TOKEN HAS EXPIRED</p>";
        }

        return view("/password/edit", ["token" => $token, "email" => $entry -> email]);
    }

    //update password
    public function update(UpdatePasswordRequest $request)
    {
        //get validated data
        $validated = $request -> validated();

        //check if input email has an active token
        if(!DB::table("password_resets") -> where("email", $validated["email"]) -> where("token", $validated["token"]) -> first())
        {
            return back() -> withErrors(["token" => "email is not linked to token"]);
        }

        //save non hashed password for login attempt
        $oldPassword = $validated["password"];

        //hash password
        $validated["password"] = bcrypt($validated["password"]);

        //get user
        $user = User::where("email", $validated["email"]);

        //update user info
        $user -> update(["password" => $validated["password"]]);

        //get user credentials
        $userValues = $user -> get() -> first();
        $userCredentials = ["email" => $userValues -> email, "name" => $userValues -> name, "password" => $oldPassword];

        //try log user in
        if(auth() -> attempt($userCredentials))
        {
            //redirect to home page
            return redirect("/post");
        }
        else
        {
            //redirect to login page
            return redirect("/login") -> withInput($validated);
        }
    }
}
