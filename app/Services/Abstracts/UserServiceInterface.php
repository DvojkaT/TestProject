<?php

namespace App\Services\Abstracts;

use App\Domain\DTO\AuthObject;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function restorePassword(Request $request): string;
}
