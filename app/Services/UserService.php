<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Abstracts\UserRepository;
use App\Services\Abstracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser(array $fields): User
    {
        return $this->repository->create($fields);
    }
}
