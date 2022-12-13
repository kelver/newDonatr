<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\CampaignRepositories;
use App\Repositories\ProfileRepositories;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProfileService
{
    protected ProfileRepositories $repository;

    public function __construct(ProfileRepositories $profileRepository)
    {
        $this->repository = $profileRepository;
    }

    public function getUserByUUid(string $identify): Builder|Model
    {
        return $this->repository->getUserByUUid($identify);
    }

    public function updateUser(array $data) :bool
    {
        return $this->repository->updateMe($data);
    }

    public function allIndications(): User|collection
    {
        return $this->repository->allIndications();
    }

    public function highlightUser()
    {
        return $this->repository->highlightUser();
    }
}
