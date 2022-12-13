<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\BioLinksRepositories;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BioLinksService
{
    protected BioLinksRepositories $repository;

    public function __construct(BioLinksRepositories $bioLinksRepository)
    {
        $this->repository = $bioLinksRepository;
    }

    public function getlinkByUuid(string $identify): Builder|Model
    {
        return $this->repository->getlinkByUuid($identify);
    }

    public function createLink(array $data): Builder|Model
    {
        return $this->repository->createLink($data);
    }

    public function updateLink(array $data, string $identify) :bool
    {
        return $this->repository->updateLink($data, $identify);
    }

    public function allLinks(): User|collection
    {
        return $this->repository->allLinks();
    }
}
