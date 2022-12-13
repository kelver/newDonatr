<?php

namespace App\Observers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Str;

class ProfileObserver
{
    public function creating(Profile $profile)
    {
        $uuid = (string) Str::uuid();

        $profile->uuid = $uuid;
        $profile->link_indication = $uuid;
    }
}
