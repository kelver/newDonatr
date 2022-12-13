<?php

namespace App\Http\Resources;

use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MeResource extends JsonResource
{
    public function toArray($request): array
    {
        if(!$this->profile){
            $this->profile = (new Profile)->create([
                'uuid' => $this->uuid,
                'user_id' => $this->id,
            ]);
        }

        return [
            'identify' => $this->uuid,
            'name' => $this->name,
            'avatar' => $this->profile->avatar,
            'email' => $this->email,
            'register' => Carbon::parse($this->created_at)->format('Y-m-d \a\t H:i:s'),
            'register_br' => Carbon::parse($this->created_at)->format('d/m/Y \à\s H:i:s'),
            'verified_status' => ($this->email_verified_at) ? true : false,
            'nickname' => $this->profile->nickname,
            'biography' => $this->profile->biography,
            'indicator' => ($this->indicator) ? (new UserResource(User::find($this->indicator))) : false,
            'link_indication' => $this->link_indication,
        ];
    }
}
