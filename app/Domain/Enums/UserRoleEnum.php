<?php

namespace App\Domain\Enums;

class UserRoleEnum extends EnumBase
{
    const ADMIN = 'admin';

    const USER = 'user';

    const WORKER = 'worker';

    public static function admin(): self
    {
        return new self(self::ADMIN);
    }

    public static function user(): self
    {
        return new self(self::USER);
    }

    public static function worker(): self
    {
        return new self(self::WORKER);
    }
}
