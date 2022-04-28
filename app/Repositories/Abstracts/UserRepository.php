<?php

namespace App\Repositories\Abstracts;

use App\Domain\DTO\WorkerFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\RepositoryInterface;

interface UserRepository extends RepositoryInterface
{
    /**
     * @param WorkerFilter|null $object
     * @param int $per_page
     * @return LengthAwarePaginator|Collection
     */
    public function filter(?WorkerFilter $object, int $per_page = 10): LengthAwarePaginator | Collection;
}
