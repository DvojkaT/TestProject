<?php

namespace App\Services;


use App\Repositories\Abstracts\PositionRepository;
use App\Repositories\Abstracts\UserRepository;
use App\Services\Abstracts\PositionServiceInterface;
use Illuminate\Support\Collection;

class PositionService implements PositionServiceInterface
{
    public PositionRepository $repository;
    public UserRepository $user_repository;

    public function __construct(PositionRepository $repository, UserRepository $user_repository)
    {
        $this->repository = $repository;
        $this->user_repository = $user_repository;
    }

    public function listPosition(string $search = null): Collection
    {
        if(!$search) {
            return $this->repository->all();
        }
        else {
            return $this->repository->findWhere([
                ['name', 'like', '%' . $search . '%'],
            ]);
        }
    }
}
