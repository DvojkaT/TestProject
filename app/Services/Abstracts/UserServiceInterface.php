<?php

namespace App\Services\Abstracts;

use App\Domain\DTO\AuthObject;
use App\Domain\DTO\WorkerFilter;
use App\Http\Resources\UserResource;
use App\Http\Resources\WorkerResource;
use App\Http\Resources\WorkersListResource;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    /**
     * @param array $fields
     * @return User
     */
    public function createUser(array $fields): User;

    /**
     * @param string $email
     * @param string $password
     * @return AuthObject
     */
    public function auth(string $email, string $password) : AuthObject;

    /**
     * @param string $email
     * @param string $token_hash
     * @return void
     */
    public function restorePassword(string $email, string $token_hash): void;

    /**
     * @param string $token
     * @param string $password
     * @return void
     */
    public function restoreConfirmPassword(string $token, string $password): void;

    /**
     * @param int $user_id
     * @return User
     */
    public function showUser(int $user_id): User;

    /**
     * @param int $user_id
     * @param array $fields
     * @return User
     */
    public function editUser(int $user_id, array $fields): User;

    /**
     * @param $id
     * @return User
     */
    public function showWorker($id): User;

    /**
     * @param WorkerFilter $object
     * @return LengthAwarePaginator
     */
    public function listWorkers(WorkerFilter $object): LengthAwarePaginator;
}
