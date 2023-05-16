<?php

namespace App\Policies;

use App\Models\Artical;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticalPolicy
{
    use HandlesAuthorization;

    //check if user can edit this post
    public function edit(User $user, Artical $artical)
    {
        return $user -> id == $artical -> author_id;
    }

    //check if user can update the post
    public function update(User $user, Artical $artical)
    {
        return $user -> id == $artical -> author_id;
    }

    //check if user can delete the post
    public function destroy(User $user, Artical $artical)
    {
        return $user -> id == $artical -> author_id;
    }
}
