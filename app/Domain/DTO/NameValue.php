<?php

namespace App\Domain\DTO;

class NameValue
{
    public string $name;

    public int $value;

    public function __construct(string $name, int $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}
