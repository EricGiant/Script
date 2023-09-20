<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user != null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Ticket $ticket)
    {
        return $ticket -> user_id == $user || $user -> is_admin == true;
    }

    //determine if user can update the appointed user
    public function updateAppointedTo(User $user)
    {
        return $user -> is_admin == true;
    }

    //determine if user can update the status
    public function updateStatus(User $user)
    {
        return $user -> is_admin == true;
    }
}
