<?php

namespace App\Services;

use App\Domain\DTO\AuthObject;
use App\Domain\Enums\UserRoleEnum;
use App\Exceptions\TokenNotFoundHttpException;
use App\Exceptions\UserNotFoundHttpException;
use App\Exceptions\WrongPasswordHttpException;
use App\Exceptions\WrongRoleHttpException;
use App\Exceptions\UserAlreadyExistsHttpException;
use App\Mail\RestorePassword;
use App\Models\User;
use App\Repositories\Abstracts\RoleRepository;
use App\Repositories\Abstracts\UserRepository;
use App\Repositories\Abstracts\UserTokenRepository;
use App\Services\Abstracts\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthService implements AuthServiceInterface
{
    public UserRepository $user_repository;

    public RoleRepository $role_repository;

    public UserTokenRepository $user_token_repository;

    public function __construct(UserRepository $user_repository, RoleRepository $role_repository, UserTokenRepository $user_token_repository)
    {
        $this->user_repository = $user_repository;
        $this->role_repository = $role_repository;
        $this->user_token_repository = $user_token_repository;
    }

    /**
     * @inheritDoc
     */
    public function createUser(array $fields): User
    {
        $user_check = $this->user_repository->findWhere([
            'email' => $fields['email'],
        ])->first();

        if ($user_check) throw new UserAlreadyExistsHttpException();

        $role = $this->role_repository->findWhere(['name' => UserRoleEnum::USER])->first();
        $fields['role_id'] = $role->id;

        $fields['password'] = Hash::make($fields['password']);

        return $this->user_repository->create($fields);
    }

    /**
     * @inheritDoc
     */
    public function auth(string $email, string $password) : AuthObject
    {
        $user = $this->user_repository->findWhere([
            'email' => $email
        ])->first();

        if (!$user) {
            throw new UserNotFoundHttpException();
        }
        elseif (!Hash::check($password, $user->password)) {
            throw new WrongPasswordHttpException();
        }

        Auth::login($user);
        $token = $user->createToken('token')->accessToken;
        return new AuthObject($token, $user, $password);

    }

    /**
     * @inheritDoc
     */
    public function restorePassword(string $email, string $token_hash): void
    {
        $user = $this->user_repository->findWhere([
            'email' => $email
        ])->first();

        $tokenFields = [
            'user_id' => $user->id,
            'token' => $token_hash,
        ];

        $token = $this->user_token_repository->create($tokenFields);

        Mail::to($email)->send(new RestorePassword($token));
    }

    /**
     * @inheritDoc
     */
    public function restoreConfirmPassword(string $token, string $password): void
    {
        $user_token = $this->user_token_repository->findWhere([
            'token' => $token
        ])->first();
        if (!$user_token) throw new TokenNotFoundHttpException();

        $user = $this->user_repository->findWhere([
            'id' => $user_token->user_id,
        ])->first();

        $user->password = Hash::make($password);

        $user->save();
    }
}
