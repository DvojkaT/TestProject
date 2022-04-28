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
     * @param int $id
     * @return User
     */
    public function showWorker(int $id): User;

    /**
     * @param WorkerFilter $object
     * @return LengthAwarePaginator
     */
    public function listWorkers(WorkerFilter $object): LengthAwarePaginator;
}
