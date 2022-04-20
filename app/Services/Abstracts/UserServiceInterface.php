<?php

namespace App\Services\Abstracts;

use App\Models\User;

interface UserServiceInterface
{
    public function createUser(array $fields): User;
}
