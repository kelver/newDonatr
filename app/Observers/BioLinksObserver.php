<?php

namespace App\Observers;

use App\Models\BioLinks;
use App\Models\User;
use Illuminate\Support\Str;

class BioLinksObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param BioLinks $links
     * @return void
     */
    public function creating(BioLinks $links)
    {
        $uuid = (string) Str::uuid();

        $links->uuid = $uuid;
    }
}
