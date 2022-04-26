<?php

namespace App\Services\Abstracts;

use Illuminate\Support\Collection;

interface DepartmentServiceInterface
{
    /**
     * @return Collection
     */
    public function listDepartments(): Collection;
}
