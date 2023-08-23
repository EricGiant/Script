<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;

class AuthenticateController extends Controller
{
    public function authenticateUser(AuthenticateUserRequest $request)
    {
        $validated = $request -> validated();

        //try to log user in
        $user = null;
        if(auth() -> attempt($validated))
        {
            $user = auth() -> user();
        }
        return response() -> json($user);
    }

    public function logout()
    {
        //log user out
        auth() -> logout();
    }
}
