<?php

namespace App\Services;

use App\Domain\DTO\AuthObject;
use App\Domain\Enums\UserRoleEnum;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Repositories\Abstracts\RoleRepository;
use App\Repositories\Abstracts\UserRepository;
use App\Services\Abstracts\UserServiceInterface;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    public UserRepository $repository;

    public RoleRepository $role_repository;

    public function __construct(UserRepository $repository, RoleRepository $role_repository)
    {
        $this->repository = $repository;
        $this->role_repository = $role_repository;
    }

    /**
     * @inheritDoc
     */
    public function createUser(array $fields): User
    {
        $role = $this->role_repository->findWhere(['name' => UserRoleEnum::USER])->first();
        $fields['role_id'] = $role->id;
        return $this->repository->create($fields);
    }

    /**
     * @inheritDoc
     */
    public function auth(LoginRequest $request) : AuthObject
    {
        $credentials = $request->validated();
        Auth::attempt($credentials);
        $user = $this->repository->findWhere([
            'email' => $credentials['email']
        ])->first();
        $token = $user->createToken('token')->accessToken;
        return new AuthObject($token, $user, $user->password);
    }
}
