<?php

namespace App\Services;

use App\Domain\DTO\AuthObject;
use App\Domain\Enums\UserRoleEnum;
use App\Mail\RestorePassword;
use App\Models\User;
use App\Repositories\Abstracts\RoleRepository;
use App\Repositories\Abstracts\UserRepository;
use App\Repositories\Abstracts\UserTokenRepository;
use App\Services\Abstracts\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserService implements UserServiceInterface
{
    public UserRepository $repository;

    public RoleRepository $role_repository;

    public UserTokenRepository $user_token_repository;

    public function __construct(UserRepository $repository, RoleRepository $role_repository, UserTokenRepository $user_token_repository)
    {
        $this->repository = $repository;
        $this->role_repository = $role_repository;
        $this->user_token_repository = $user_token_repository;
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
    public function auth(string $email, string $password) : AuthObject
    {
        Auth::attempt(['email' => $email, 'password' => $password]);
        $user = $this->repository->findWhere([
            'email' => $email
        ])->first();
        $token = $user->createToken('token')->accessToken;
        return new AuthObject($token, $user, $user->password);
    }

    public function restorePassword(string $email, string $token_hash): void
    {
        $user = $this->repository->findWhere([
            'email' => $email
        ])->first();

        $tokenFields = [
            'user_id' => $user->id,
            'token' => $token_hash,
        ];

        $token = $this->user_token_repository->create($tokenFields);

        Mail::to($email)->send(new RestorePassword($token));
    }

    public function restoreConfirmPassword(string $token, string $password)
    {
        $user_token = $this->user_token_repository->findWhere([
            'token' => $token
        ])->first();

        if (!$user_token) abort('404');

        $user = $this->repository->findWhere([
            'id' => $user_token->user_id,
        ])->first();

        $user->password = $password;

        $user->save();
    }
}
