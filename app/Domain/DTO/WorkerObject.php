<?php

namespace App\Domain\DTO;

class WorkerObject
{
    public ?string $query;

    public ?int $department_id;

    public ?int $position_id;


    public function __construct(string $query = null,int $department_id = null, int $position_id = null)
    {
        $this->query = $query;

        $this->department_id = $department_id;

        $this->position_id = $position_id;
    }
}
