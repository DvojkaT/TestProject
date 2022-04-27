<?php

namespace App\Services\Abstracts;

use App\Http\Requests\SearchRequest;
use Illuminate\Support\Collection;

interface DepartmentServiceInterface
{
    /**
     * @return Collection
     */
    public function listDepartments(int $user_id, string $search = null): Collection;
}
