<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatPolicy
{
    use HandlesAuthorization;

    //check if user can see this chat
    public function view(User $user, Chat $chat)
    {
        $userIds = collect($chat["user1_id"], $chat["user2_id"]);
        if($userIds -> contains(auth() -> user() -> id))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
