<?php

namespace App\Services;

use App\Domain\Enums\UserRoleEnum;
use App\Models\User;
use App\Repositories\Abstracts\RoleRepository;
use App\Repositories\Abstracts\UserRepository;
use App\Services\Abstracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public UserRepository $repository;

    public RoleRepository $role_repository;

    public function __construct(UserRepository $repository, RoleRepository $role_repository)
    {
        $this->repository = $repository;
        $this->role_repository = $role_repository;
    }

    public function createUser(array $fields): User
    {
        $role = $this->role_repository->findWhere(['name' => UserRoleEnum::USER])->first();
        $fields['role_id'] = $role->id;
        return $this->repository->create($fields);
    }

}
