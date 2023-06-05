<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    //check if user is updating there own post
    public function update(User $user, Post $post)
    {
        return $user -> id == $post -> user -> id;
    }

    //check if user is deleting there own post
    public function delete(User $user, Post $post)
    {
        return $user -> id == $post -> user -> id;
    }
}
