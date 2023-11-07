<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Resources\UserResource;

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
}
