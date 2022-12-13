<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BioLinksResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'identify' => $this->uuid,
            'title' => $this->title,
            'url' => $this->url,
            'status' => $this->when($this->status == true, 'Ativo', 'Inativo'),
        ];
    }
}
