<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Requests\UpdateAuthenticatePasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthenticateController extends Controller
{
    public function authenticateUser(AuthenticateUserRequest $request)
    {
        $validated = $request -> validated();

        if(auth() -> attempt($validated))
        {
            return response(new UserResource(auth() -> user()));
        }
        else
        {
            return "login failed";
        }
    }

    public function logout()
    {
        //log user out
        auth() -> logout();
    }

    
    // public function getLoggedInUser(Request $request)
    // {
    //  return $request->user();
    // }

    // public function getLoggedInUser()
    // {
    //     return response(new UserResource(auth() -> user()));
    // }

    public function sendResetPasswordEmail()
    {
        dd("NOT IMPLOMENTED");
    }

    public function updatePassword(UpdateAuthenticatePasswordRequest $request)
    {
        $validated = $request -> validated();

        User::where("email", DB::table("password_resets") -> where("token", $validated["token"]) -> pluck("email")) -> update(["password" => Hash::make($validated["password"])]);
    }
}
