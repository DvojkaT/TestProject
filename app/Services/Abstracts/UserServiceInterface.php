<?php

namespace App\Services\Abstracts;

use App\Domain\DTO\AuthObject;
use App\Http\Requests\LoginRequest;
use App\Models\User;

interface UserServiceInterface
{
    /**
     * @param array $fields
     * @return User
     */
    public function createUser(array $fields): User;

    /**
     * @param LoginRequest $request
     * @return AuthObject
     */
    public function auth(LoginRequest $request) : AuthObject;
}
