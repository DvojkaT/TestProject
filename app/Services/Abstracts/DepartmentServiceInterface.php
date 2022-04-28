<?php

namespace App\Services\Abstracts;

use App\Http\Requests\SearchRequest;
use Illuminate\Support\Collection;

interface DepartmentServiceInterface
{
    /**
     * @return Collection
     */
    public function listDepartments(int $user_id = null, string $search = null): Collection;
}
