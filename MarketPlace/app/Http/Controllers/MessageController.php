<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Mail\NewMessage;
use App\Models\Chat;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    //store new messages
    public function store(StoreMessageRequest $request)
    {
        //get validated data
        $validated = $request -> validated();

        //get chat id
        $chat_id = str_replace($request -> root() . "/chat/", "", back() -> getTargetUrl());           

        //make data
        $messageData = ["chat_id" => $chat_id, "sender_id" => auth() -> user() -> id, "content" => $validated["content"]];

        //make message
        $message = Message::create($messageData);

        //update chats updated_at
        $chat = Chat::Find($chat_id);
        $chat -> touch();

        //send email to reciever
        $sender = "";
        $receiverEmail = "";
        if($chat -> user1 -> id == auth() -> user() -> id)
        {
            $sender = auth() -> user() -> name;
            $receiverEmail = $chat -> user2 -> email;
        }
        else
        {
            $sender = auth() -> user() -> name;
            $receiverEmail = $chat -> user1 -> email;
        }

        Mail::to($receiverEmail) -> send(new NewMessage($sender, $chat_id));

        //go back to message page
        return back();
    }
}
