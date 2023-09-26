<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Requests\SendResetPasswordEmailRequest;
use App\Http\Requests\UpdateAuthenticatePasswordRequest;
use App\Http\Resources\UserResource;
use App\Mail\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
            return response() -> json(["message" => "Password is invalid"], 401);
        }
    }

    public function logout()
    {
        auth() -> logout();
    }

    
    public function getLoggedInUser(Request $request)
    {
     return $request->user();
    }

    // public function getLoggedInUser()
    // {
    //     return response(new UserResource(auth() -> user()));
    // }

    public function sendResetPasswordEmail(SendResetPasswordEmailRequest $request)
    {
        $validated = $request -> validated();

        $token = Str::random(50);
        while(DB::table("password_resets") -> where("token", $token) -> exists())
        {
            $token = Str::random(50);
        }

        $validated["token"] = $token;
        $validated["created_at"] = Carbon::now() -> toDateTimeString();
        DB::table("password_resets") -> insert($validated);

        Mail::to($validated["email"]) -> send(new ResetPassword($token));
    }

    public function updatePassword(UpdateAuthenticatePasswordRequest $request)
    {
        $validated = $request -> validated();

        User::where("email", DB::table("password_resets") -> where("token", $validated["token"]) -> pluck("email")) -> update(["password" => Hash::make($validated["password"])]);
    }
}
