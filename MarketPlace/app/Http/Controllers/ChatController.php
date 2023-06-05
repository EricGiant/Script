<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRequest;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //show all chats from user
    public function index()
    {
        //get all chats from user sorted on most recent activity
        $chats = Chat::where("user1_id", auth() -> user() -> id) -> orWhere("user2_id", auth() -> user() -> id) -> orderBy("updated_at", "desc") -> get();

        return view("/chat/index", ["chats" => $chats]);
    }

    //make new chat
    public function store(StoreChatRequest $request)
    {
        //get validated data
        $validated = $request -> validated();

        //make chat data
        $chatData = ["user1_id" => auth() -> user() -> id, "user2_id" => $validated["seller_id"]];

        //make new chat
        $chat = new Chat($chatData);
        $chat -> save();

        //load chat
        return redirect("/chat/" . $chat -> id);
    }

    //show selected chat
    public function show(Chat $chat)
    {
        //check if user can see this chat
        $this -> authorize("view", $chat);

        //set user stuff in chat veriable for easier frontend work
        //user1 is always the current application
        $chat["user1"] = auth() -> user();
        if($chat["user1"] -> id == $chat["user1_id"])
        {
            $chat["user2"] = $chat -> user2;    
        }
        else
        {
            $chat["user2"] = $chat -> user1;
        }

        return view("/chat/show", ["chat" => $chat]);
    }
}
