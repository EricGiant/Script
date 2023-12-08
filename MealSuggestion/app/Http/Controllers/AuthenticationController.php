<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Resources\UserResource;
use App\Mail\ForgotPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function authenticateUser(AuthenticateUserRequest $request)
    {
        $validated = $request->validated();

        if(auth()->attempt($validated))
        {
            return response(1, 202);
        }
        else
        {
            return response(['errors' => ['password' => 'Password is invalid']], 404);
        }
    }

    public function getAuthenticatedUser()
    {
        if(auth()->user())
        {
            return response(new UserResource(auth()->user()));
        }
        else
        {
            return response(null, 404);
        }
    }

    public function logUserOut()
    {
        auth()->logout();
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $validated = $request->validated();

        $token = Str::random(50);
        while(DB::table('password_resets')->where('token', $token)->exists())
        {
            $token = Str::random(50);
        }

        $validated['token'] = $token;
        $validated['created_at'] = Carbon::now()->toDateTimeString();
        DB::table('password_resets')->insert($validated);

        Mail::to($validated['email'])->send(new ForgotPassword($token));
    }
}
