<?php

namespace App\Repositories\Abstracts;

use App\Domain\DTO\WorkerObject;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\RepositoryInterface;

interface UserRepository extends RepositoryInterface
{
    public function filter(?WorkerObject $object, int $per_page = 10): LengthAwarePaginator | Collection;
}
