<?php

namespace App\Domain\DTO;

use App\Models\User;

class AuthObject
{
    public string $token;

    public User $user;

    public string $password;

    public function __construct(string $token, User $user, string $password)
    {
        $this->token = $token;

        $this->user = $user;

        $this->password = $password;
    }

}
