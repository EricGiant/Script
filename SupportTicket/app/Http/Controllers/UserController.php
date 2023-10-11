<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResource_withoutEmail_withoutTelephoneNumber;
use App\Mail\NewUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        if(auth() -> user() -> is_admin)
        {
            return response(UserResource::collection(User::all()));
        }
        else
        {
            $users = [auth() -> user()];
            foreach(auth() -> user() -> tickets as $ticket)
            {
                array_push($users, $ticket -> appointed_to_user);
            }
            return response(UserResource_withoutEmail_withoutTelephoneNumber::collection($users));
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request -> validated();

        $this -> authorize("update", User::class);

        $user -> update($validated);

        return response($this -> index());
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
     
        return response($this -> index());
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request -> validated();

        $user = new User();
        $user -> fill($validated);
        $user -> password = Hash::make($validated["password"]);
        $user -> save();

        Mail::to($user -> email) -> send(new NewUser);

        return response($this -> index());
    }
}