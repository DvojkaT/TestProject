<?php

namespace App\Services\Abstracts;

use Illuminate\Support\Collection;

interface DepartmentServiceInterface
{
    public function listDepartments(): Collection;
}
