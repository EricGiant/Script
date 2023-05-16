<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    //check if user can edit this comment
    public function edit(User $user, Comment $comment)
    {
        return $user -> id == $comment -> author_id;
    }

    //check if user can update the comment
    public function update(User $user, Comment $comment)
    {
        return $user -> id == $comment -> author_id;
    }

    //check if user can delete the comment
    public function destroy(User $user, Comment $comment)
    {
        return $user -> id == $comment -> author_id;
    }
}
