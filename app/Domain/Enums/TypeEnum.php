<?php

namespace App\Domain\Enums;

class TypeEnum extends EnumBase
{
    const BACKEND = 'backend';

    const FRONTEND = 'frontend';

    public static function backend(): self
    {
        return new self(self::BACKEND);
    }

    public static function frontend(): self
    {
        return new self(self::FRONTEND);
    }
}
