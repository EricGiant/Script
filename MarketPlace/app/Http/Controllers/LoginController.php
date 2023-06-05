<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowLoginRequest;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\UpdateLoginRequest;
use App\Mail\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //show login page
    public function index()
    {
        return view("login/index");
    }

    //show create account page
    public function create()
    {
        return view("login/create");
    }

    //create new user
    public function store(StoreLoginRequest $request)
    {
        //get validated data
        $validated = $request -> validated();

        //hash password
        $validated["password"] = bcrypt($validated["password"]);

        //make new user entry
        $user = new User($validated);
        $user -> save();

        //log user in
        auth() -> login($user);

        //return to home page
        return redirect("/post");
    }

    //log user in
    public function show(ShowLoginRequest $request)
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
    
    //show reset password page
    public function edit()
    {
        return view("login/edit");
    }

    //send email for password reset
    public function update(UpdateLoginRequest $request)
    {
        //get validated data
        $validated = $request -> validated();

        //generate initial token
        $token = Str::random(50);
        
        //keep generating tokens until a unique token is generated
        while(DB::table("password_resets") -> where("token", $token) -> exists())
        {
            $token = Str::random(50);
        }

        //save token to DB
        $entry = ["email" => $validated["email"], "token" => $token, "created_at" => Carbon::now() -> toDateTimeString()];
        DB::table("password_resets") -> insert($entry);

        //send email
        Mail::to($validated["email"]) -> send(new ResetPassword($token));

        return redirect("/login");
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
