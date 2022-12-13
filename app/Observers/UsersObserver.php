<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UsersObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param User $books
     * @return void
     */
    public function creating(User $user)
    {
        $uuid = (string) Str::uuid();

        $user->uuid = $uuid;
    }
}
