<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\User;

class UserObserver
{
    /**
     * Listen to the User creating event.
     *
     * @param  User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->setRememberToken(str_random(10));

        if ($user->role === null) {
            // give new users a default read only role.
            $role = Role::where('name', 'ROLE_READ')->first();
            if ($role !== null) {
                $user->role()->associate($role);
            }
        }
    }
}