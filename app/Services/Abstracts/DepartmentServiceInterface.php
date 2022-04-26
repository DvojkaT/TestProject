<?php

namespace App\Services\Abstracts;

use App\Http\Requests\SearchRequest;
use Illuminate\Support\Collection;

interface DepartmentServiceInterface
{
    /**
     * @return Collection
     */
    public function listDepartments(string $search = null): Collection;
}
