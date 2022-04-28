<?php

namespace App\Repositories;

use App\Domain\DTO\WorkerFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Repositories\Abstracts\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model()
    {
        return User::class;
    }

    /**
     * @inheritDoc
     */
    public function filter(?WorkerFilter $object, int $per_page = 10): LengthAwarePaginator | Collection
    {
        /** @var Builder $builder */
        $builder = $this->model;

        if($object === null) {
            return $builder->get();
        }

        if ($object->position_id) {
            $builder = $builder->where('position_id', '=', $object->position_id);
        }

        if ($object->department_id) {
            $builder = $builder->where('department_id', '=', $object->department_id);
        }

        if ($object->query) {
            $builder = $builder->where('name', '=', $object->query);
        }
        return $builder->paginate($per_page);
    }
}
