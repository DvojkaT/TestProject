<?php

namespace App\Services;

use App\Domain\DTO\WorkerFilter;
use App\Models\User;
use App\Repositories\Abstracts\UserRepository;
use App\Services\Abstracts\UserServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService implements UserServiceInterface
{
    public UserRepository $repository;


    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function showUser(int $user_id): User
    {
        return $this->repository->findWhere([
            'id' => $user_id
        ])->first();
    }

    /**
     * @inheritDoc
     */
    public function editUser(int $user_id, array $fields): User
    {
        return $this->repository->update($fields, $user_id);
    }

    /**
     * @inheritDoc
     */
    public function showWorker(int $id): User
    {
        return $this->repository->findWhere([
            'id' => $id,
        ])->first();
    }

    /**
     * @inheritDoc
     */
    public function listWorkers(WorkerFilter $object): LengthAwarePaginator
    {
        return $this->repository->filter($object);
    }
}
