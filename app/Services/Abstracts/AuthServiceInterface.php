<?php

namespace App\Services\Abstracts;

use App\Domain\DTO\AuthObject;
use App\Models\User;

interface AuthServiceInterface
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
}
