<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'identify' => $this->uuid,
            'name' => $this->name,
            'avatar' => $this->when($this->isProfile, $this->profile->avatar ?? ''),
            'email' => $this->email,
            'nickname' => $this->when($this->isProfile, $this->profile->nickname ?? ''),
            'biography' => $this->when($this->isProfile, $this->profile->biography ?? ''),
            'gender' => $this->when($this->isProfile, $this->profile->gender ?? ''),
            'indicator' => $this->when($this->isProfile, $this->profile?->indicator) ?
                (new UserResource(User::find($this->profile?->indicator))) : false,
            'indication' => $this->when($this->isProfile, $this->profile->link_indication ?? ''),
            'verified_status' => ($this->email_verified_at) ? true : false,
            'register' => Carbon::parse($this->created_at)->format('Y-m-d \a\t H:i:s'),
            'register_br' => Carbon::parse($this->created_at)->format('d/m/Y \à\s H:i:s'),
        ];
    }
}
