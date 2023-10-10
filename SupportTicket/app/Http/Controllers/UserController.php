<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Mail\NewUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        return response(UserResource::collection(User::all()));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request -> validated();

        $this -> authorize("update", User::class);

        $user -> update($validated);

        return response(UserResource::collection(User::all()));
    }

    public function delete(User $user)
    {
        $this -> authorize("delete", User::class);

        //check if user has any non afgehandelde tickets
        if($user -> tickets -> contains(function ($ticket)
        {
            return $ticket["status_id"] == 1 || $ticket["status_id"] == 2;
        }))
        {
            return response("ticketFound");
        }
        
        //get all the users appointed_to tickets and set the appointed_to_id to null so it doesn't cause a constraight key vialotion
        $user -> appointed_to_tickets() -> update(["appointed_to_id" => null]);

        $user -> delete();
     
        return response(UserResource::collection(User::all()));
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request -> validated();

        // $validated["password"] = Hash::make($validated["password"]); //i did my old way in every project so far with 0 critism on it
        $user = new User();
        $user -> fill($validated);
        $user -> password = Hash::make($validated["password"]);
        $user -> save();

        Mail::to($user -> email) -> send(new NewUser);

        return response(UserResource::collection(User::all()));
    }
}