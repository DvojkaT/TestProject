<?php

namespace App\Services;

use App\Domain\DTO\AuthObject;
use App\Domain\DTO\WorkerObject;
use App\Domain\Enums\UserRoleEnum;
use App\Exceptions\UserAlreadyExistsHttpException;
use App\Exceptions\TokenNotFoundHttpException;
use App\Http\Resources\UserResource;
use App\Http\Resources\WorkerResource;
use App\Http\Resources\WorkersListResource;
use App\Mail\RestorePassword;
use App\Models\User;
use App\Repositories\Abstracts\DepartmentRepository;
use App\Repositories\Abstracts\PositionRepository;
use App\Repositories\Abstracts\RoleRepository;
use App\Repositories\Abstracts\UserRepository;
use App\Repositories\Abstracts\UserTokenRepository;
use App\Services\Abstracts\UserServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService implements UserServiceInterface
{
    public UserRepository $repository;

    public RoleRepository $role_repository;

    public UserTokenRepository $user_token_repository;

    public DepartmentRepository $department_repository;

    public PositionRepository $position_repository;

    public function __construct(UserRepository $repository, RoleRepository $role_repository,
                                UserTokenRepository $user_token_repository, DepartmentRepository $department_repository,
                                PositionRepository $position_repository)
    {
        $this->repository = $repository;
        $this->role_repository = $role_repository;
        $this->user_token_repository = $user_token_repository;
        $this->department_repository = $department_repository;
        $this->position_repository = $position_repository;
    }

    /**
     * @inheritDoc
     */
    public function createUser(array $fields): User
    {
        $user_check = $this->repository->findWhere([
            'email' => $fields['email'],
        ])->first();

        if($user_check) throw new UserAlreadyExistsHttpException();

        $role = $this->role_repository->findWhere(['name' => UserRoleEnum::USER])->first();
        $fields['role_id'] = $role->id;
        return $this->repository->create($fields);
    }

    /**
     * @inheritDoc
     */
    public function auth(string $email, string $password) : AuthObject
    {
            $user = $this->repository->findWhere([
                'email' => $email
            ])->first();
            if (!Hash::check($password, $user->password)) {
               throw new TokenNotFoundHttpException();
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

    /**
     * @inheritDoc
     */
    public function restoreConfirmPassword(string $token, string $password): void
    {
        $user_token = $this->user_token_repository->findWhere([
            'token' => $token
        ])->first();
        if (!$user_token) throw new TokenNotFoundHttpException();

        $user = $this->repository->findWhere([
            'id' => $user_token->user_id,
        ])->first();

        $user->password = Hash::make($password);

        $user->save();
    }

    public function showUser(int $user_id): UserResource
    {
        $user = $this->repository->findWhere([
            'id' => $user_id
        ])->first();

        return new UserResource($user);
    }

    public function editUser(int $user_id, array $fields): UserResource
    {
        $user = $this->repository->findWhere([
            'id' => $user_id,
    ])->first();
        $user->update($fields);

        return new UserResource($user);
    }

    public function showWorker($id): WorkerResource
    {
        $worker = $this->repository->findWhere([
            'id' => $id,
        ])->first();

        return new WorkerResource($worker);
    }

    public function listWorkers(WorkerObject $object): LengthAwarePaginator
    {
        return $this->repository->filter($object);
    }
}
