<?php

namespace App\Policies;

use App\Models\Bid;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BidPolicy
{
    use HandlesAuthorization;

    //check if user is updating there own bid
    public function update(User $user, Bid $bid)
    {
        return $user -> id == $bid -> user -> id;
    }

    //check if user is deleting there own bid
    public function delete(User $user, Bid $bid)
    {
        return $user -> id == $bid -> user -> id;
    }
}
